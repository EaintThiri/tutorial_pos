<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //direct order list
    public function orderList(){
        $order=Order::when(request('key'),function($query){
            $query->orwhere("users.name","like","%".request('key')."%")
                ->orwhere("orders.order_code","like","%".request('key')."%");
        })
            ->select("orders.*","users.name as userName")
            ->leftJoin('users','users.id','orders.user_id')
            ->orderBy('orders.created_at','desc')
            ->get();

        return view('admin.order.list',compact('order'));
    }
    //sort with ajax
    public function changeStatus(Request $request){
        //$request->status=$request->status==null ? "":$request->status;
          // ->orWhere('orders.status',$request->status)
         // ->get();
                $order=Order::select('orders.*',"users.name as userName")
                ->leftJoin('users','users.id','orders.user_id')
                ->orderBy('created_at','desc');


                if($request->status==null){
                    $order=$order->get();
                }else{
                    $order=$order->where("orders.status",$request->status)->get();
                }




       return view('admin.order.list',compact('order'));

    }

    //ajax change status
    public function ajaxChangeStatus(Request $request){


       Order::where('id',$request->orderId)->update([
            "status"=>$request->status
       ]);


    }

    //order list info
    public function listInfo($order_code){
        //  ->get();
        //delete();
        $order=Order::where('order_code',$order_code)->first();
        $orderList=OrderList::select("order_lists.*","users.name as userName",'products.name as productName','products.image as productImage')
                      ->leftJoin('users','order_lists.user_id','users.id')
                      ->leftJoin('products','order_lists.product_id','products.id')
                      ->where('order_lists.order_code',$order_code)
                     ->get();

        return view("admin.order.productList",compact("orderList","order"));


    }
   // deleteOrder
    public function deleteOrder(Request $request){
        Order::where('user_id',$request->userId)->delete();
        OrderList::where('user_id',$request->userId)->delete();

    }
}
