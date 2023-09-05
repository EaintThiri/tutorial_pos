<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
      //contact Page
    public function contactPage(){
        return view('user.main.contact');
    }
    //user contact

    public function contact(Request $request,$id){
        $data=$this->getUserData($request);
        $this->accountValidationCheck($request);
        Contact::create($data);
        return redirect()->route("user#home");

    }

    //admin-> user contact list
    public function userContactList(){
        $userContact=Contact::select('contacts.*','users.id as user_id',)
                            ->leftJoin('users','users.id','contacts.user_id')
                            ->get();
        return view('admin.user.contactList',compact('userContact'));
    }

    //detail page
  public function detailPage($id){

    $contact=Contact::where('id',$id)->first();


    return view('admin.user.detail',compact('contact'));
  }

//contac tDelete
  public function deleteContact(Request $request){
    Contact::where('id',$request->contactId)->delete();
  }

    private function accountValidationCheck($request){
        Validator::make($request->all(),[

           'name'=>'required',
            'email'=>'required',
            'message'=>'required|min:10',

        ])->validate();
    }

    private function getUserData($request){
        return[
            'user_id'=>Auth::user()->id,
             'name'=>$request->name,
            'email'=>$request->email,
            'message'=>$request->message,
            'created_at'=>Carbon::now(),
        ];
    }
}
