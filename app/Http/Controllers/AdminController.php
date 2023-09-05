<?php

namespace App\Http\Controllers;
use Storage;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
      //change Password Page
    public function changePasswordPage(){
        return view('admin.account.changePassword');
    }
    //change Password
    public function changePassword(Request $request){

        // 1.all fields requird
        // 2.new passowrd & confirm password length must be greater than 6
        //3.new passord confirm password must same
        //4.client old password & db_password same

        //5.password change

        $this->passwordValidationCheck($request);
        $currentId=Auth::user()->id;
        $user=User::select('password')->where('id',$currentId)->first();
        $dbhashedValue=$user->password;

        if(Hash::check($request->oldPassword, $dbhashedValue)){
                $data=[
                    'password'=>Hash::make($request->newPassword)
                ];
            User::where('id',$currentId)->update($data);

                return redirect()->route('category#list')->with(['changeSuccess'=>'Password Changed....']);
        }
        return back()->with(['notMatch'=>'The Old Password do not match.Try Again..']);



        // dd($dbPassword);

    //    $hashValue= Hash::make('thiri');
    //     if(Hash::check('codelab', $hashValue)){
    //         dd('correct');
    //     }
    //     else
    //     dd('false');


    }

    //Admin details
    public function details(){
        return view('admin.account.detail');
    }

    // direct admin edit profile
    public function edit(){
        return view('admin.account.edit');
    }
    //direct update page
    public function update($id,Request $request){
        $this->accountValidationCheck($request);
        $data=$this->getUserData($request);
        //for image
        if($request->hasFile('image')){
            //old image name //check //if has->delete  //store
            $dbImage=User::where('id',$id)->first();
            $dbImage=$dbImage->image;

            //image delete
            if($dbImage != null){
                Storage::delete('public/'.$dbImage);
            }
            //imagestore
            $fileName=uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image']=$fileName;
        }
        User::where('id',$id)->update($data);
        return redirect()->route('admin#details')->with(['updateSuccess'=>'Admin Account Updated...']);
    }

    //admin list
    public function list(){
        $admin=User::when(request('key'),function($query){
            $query->orWhere('name','like',"%".request('key')."%")
                 ->orWhere('email','like',"%".request('key')."%")
                  ->orWhere('gender','like',"%".request('key')."%")
                 ->orWhere('phone','like',"%".request('key')."%")
                 ->orWhere('address','like',"%".request('key')."%");

        })

        ->where('role','admin')
        ->paginate(3);
          $admin->appends(request()->all());
        return view('admin.account.list',compact('admin'));

    }
    //admin list delete
    public function delete($id){
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Admin Account Deleted']);

    }
    //change Role
    public function changeRole(Request $request){

        $account=User::where('id',$id)->first();

        return view('admin.account.changeRole',compact('account'));
    }

    public function change(Request $request){
        // $data=$this->requestUserData($request);
        // $data=$this-> getUserData($request);
        // $this->accountValidationCheck($request);

        // if($request->hasFile('image')){
        //     $oldImageName=User::where('id',$id)->first();
        //     $oldImageName=$oldImageName->image;

        //     if($oldImageName != null){
        //         Storage::delete('public/.'.$oldIMageName);
        //     }
        //     $fileName=uniqid().$request->file('image')->getClientOriginalName();
        //     $request->file('image')->storeAs('public./'.$fileName);
        //     $data['image']=$fileName;
        // }
        $role=User::where('id',$request->userId)->update([
            'role'=>$request->roleStatus
        ]);

        return redirect()->route('admin#list',compact('role'));
    }



    //
    private function requestUserData($request){
        return[
            'role'=>$request->role,
        ];
    }


    //request user data
    private function getUserData($request){
        return [
            'name'=>$request->name,
            'email'=>$request->email,
            'gender'=>$request->gender,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'updated_at'=>Carbon::now(),
        ];
    }
    //account validation check
    private function accountValidationCheck($request){
       $validationRule=[
         'name'=>'required',$request->id,
             'email'=>'required',
              'gender'=>'required',
               'phone'=>'required',
               'image'=>'mimes:png,jpeg,jpg|file',
                'address'=>'required',
       ];
       Validator::make(request()->all(),$validationRule)->validate();
    }

    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            "oldPassword"=>"required|min:6",
            "newPassword"=>"required|min:6|max:10",
            "confirmPassword"=>"required|min:6|max:10|same:newPassword",
    ])->validate();
    }
}
