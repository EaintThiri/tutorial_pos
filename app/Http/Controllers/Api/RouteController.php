<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    //get all product List
    public function productList(){
        $products=Product::get();
        $users=User::get();
        $orders=Order::get();

        $data=[
           'product'=>$products,
           'user'=>$users,
           'order'=>$orders
        ];
        return response()->json($data,200);
    }

    //get all category list
    public function categoryList(){
        $category=Category::orderBy('id','desc')->get();
        return response()->json($category,200);
    }

    //categoryCreate
    public function categoryCreate(Request $request){

        //dd($request->header('header-data'));
        $data=$this->getClientData($request);
         $response=Category::create($data);

         return  response()->json($response, 200);
    }
    //contactContact
    public function contactContact(Request $request){
     $data=$this->getContactData($request);

       Contact::create($data);
       $response=Contact::orderBy('id','desc')->get();
       return  response()->json($response, 200);
    }

    private function getClientData($request){
        return[

            'name'=>$request->name,
            'created_at'=>Carbon::now(),
            'update_at'=>Carbon::now(),

        ];
    }

    //categoryDelete
    public function categoryDelete($id,Request $request){


        $data=Category::where('id',$id)->first();
        // return isset($data);
        //return empty($data);
        // dd(isset($data));
        if(isset($data)){
             Category::where('id',$id)->delete();
        return response()->json(['status'=>true,'message'=>'delete success','delete data'=>$data], 200);
        }
        return response()->json(['status'=>false,'message'=>'there is no data'], 200 );


    }
    //categoryDetail
    public function categoryDetails($id,Request $request){
        $data=Category::where('id',$id)->first();

       if(isset($data)){
        return response()->json(['status'=>true,'message'=>'data exit..','data'=>$data], 200 );
       }
       return response()->json(['status'=>false,'message'=>'there is no data'], 500);
    }

    //updateCategory
    public function updateCategory(Request $request)
    {

        $categoryId=$request->category_id;

        $dbSource=Category::where('id',$categoryId)->first();
        if(isset($dbSource)){

                 $data=$this->getCategoryData($request);
                 Category::where('id',$categoryId)->update($data);
                 $response=Category::where('id',$categoryId)->first();
                 return response()->json(['status'=>true,'category'=>$response,'message'=>'category update success'], 200);
        }
        return response()->json(['status'=>false,'message'=>'there is no category update'], 500);



        return $data;

    }

    private function getCategoryData($request){
        return[
            'name'=>$request->category_name,

            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ];
    }
    private function getContactData($request){
        return [
            'user_id'=>$request->user_id,
            'name'=>$request->name,
            'email'=>$request->email,
            'message'=>$request->message,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ];
    }


}
