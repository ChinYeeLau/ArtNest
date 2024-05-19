<?php

namespace App\Http\Controllers\Front;

use Auth;
use App\Models\Order;
use App\Models\OrdersProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function orders($id=null){
        if(empty($id)){
            $orders =Order::with('orders_products')->where('user_id',Auth::user()->id)->orderBy('id','Desc')->get()->toArray();
       return view('front.orders.orders')->with(compact('orders'));
        }else{
           $orderDetails=Order::with('orders_products')->where('id',$id)->first()->toArray();
           //dd($orderDetails);
           return view('front.orders.order_details')->with(compact('orderDetails'));

        }
       
    }
}
