<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //user home page
    public function home(){
        $pizza=Product::orderBy('created_at','desc')->get();
        $category=Category::get();
        $cart=Cart::where('user_id',Auth::user()->id)->get();
         $history=Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizza','category','cart','history'));
    }
    //password change page
    public function changePasswordPage(){
        return view('user.password.change');
    }
    //password change
    public function changePassword(Request $request){
        $this->passwordValidationCheck($request);
        $data=User::select('password')->where('id',Auth::user()->id)->first();
        $dbHashValue=$data->password;

        if(Hash::check($request->oldPassword, $dbHashValue)){
            $data=[
                'password'=>Hash::make($request->newPassword)
            ];
            User::where('id',Auth::user()->id)->update($data);
            return redirect()->route('user#home')->with(['changeSuccess'=>'Updated Successs..']);

        }
        return back()->with(['notMatch'=>'old Password are not match.Try Again']);

    }
    //Account Change Page
    public function accountChangePage(){
        return view('user.profile.account');
    }

    //Account Change
    public function accountChange(Request $request,$id){
        $this->accountValidationCheck($request);
        $data=$this->getUserData($request);

        if($request->hasFile('image')){
            $oldImageName=User::where('id',$id)->first();
            $oldImageName=$oldImageName->image;

            if($oldImageName!=null){
                Storage::delete('public/'.$oldImageName);
            }

            $fileName=uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/'.$fileName);
            $data['image']=$fileName;
        }
        User::where('id',$id)->update($data);
        return back()->with(['updateSuccess'=>'Account Updated Success...']);
    }

     //filter pizza
    public function filterPage($categoryId){
        $pizza=Product::where('category_id',$categoryId)->orderBy('price','desc')->get();
        $category=Category::get();
         $cart=Cart::where('user_id',Auth::user()->id)->get();
          $history=Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizza','category','cart','history'));


    }

    //pizza Detail
    public function pizzaDetail($pizzaId){
        $pizza=Product::where('id',$pizzaId)->first();
        $pizzaList=Product::get();
        return view('user.main.detail',compact('pizza','pizzaList'));
    }

    //cart list

    public function cartList(){
        $cartList=Cart::select('carts.*','products.name as pizza_name','products.price as pizza_price' ,'products.image as product_image')
        ->leftJoin('products','products.id','carts.product_id')
        ->where('carts.user_id',Auth::user()->id)
        ->get();

        $totalPrice=0;
        foreach($cartList as $c){
            $totalPrice+=$c->pizza_price * $c->qty;
            //  dd($totalPrice);
        }
        return view('user.main.cart',compact('cartList','totalPrice'));
    }
//history page
    public function history(){
        $order=Order::where('user_id',Auth::user()->id)
        ->orderBy('created_at','desc')
        ->paginate("6");
        return view('user.main.history',compact('order'));
    }
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword'=>'required|min:6|max:10',
             'newPassword'=>'required|min:6|max:10',
              'confirmPassword'=>'required|min:6|max:10|same:newPassword'
        ])->validate();
    }





    private function accountValidationCheck($request){
        Validator::make($request->all(),[
           'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'gender'=>'required',
             'address'=>'required',
             'image'=>'mimes:png,jpg,jpeg,jiff|file',
        ])->validate();
    }

    private function getUserData($request){
        return[
             'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'gender'=>$request->gender,
            'address'=>$request->address,
            'updated_at'=>Carbon::now(),
        ];
    }


    //listPage
    public function listPage(Request $request){

       $data=[
        'role'=>$request->role
       ];
      User::where('id',$request->userId)->update($data);
        $users=User::where('role','user')->paginate(3);
      return view('admin.user.userList',compact('users'));
    }

    //delete user
     //user delete
    public function userDelete(Request $request){

        User::where('id',$request->userId)->delete();


    }


}
