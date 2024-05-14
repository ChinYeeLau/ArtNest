<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Models\DeliveryAddress;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;

class AddressController extends Controller
{
    public function getDeliveryAddress(Request $request){
        if($request->ajax()){
            $data=$request->all();
            $deliveryAddresses=DeliveryAddress::where('id',$data['addressid'])->first()->toArray();
            return response()->json(['address'=> $deliveryAddresses]);

        }
    }
    public function saveDeliveryAddress(Request $request){
        if($request->ajax()){
            $data=$request->all();
           // echo "<pre>";print_r($data);die;
           $address=array();
           $address['user_id']=Auth::user()->id;
           $address['name']=$data['delivery_name'];
           $address['address']=$data['delivery_address'];
           $address['state']=$data['delivery_state'];
           $address['postcode']=$data['delivery_postcode'];
           $address['mobile']=$data['delivery_mobile'];
           if(!empty($data['delivery_id'])){
             //edit delivery address
             DeliveryAddress::where('id',$data['delivery_id'])->update($address);
           }else{
           // $address['status']=1;
            //add delivery address
            DeliveryAddress::create($address);
        }
            $deliveryAddresses=DeliveryAddress::deliveryAddresses();
           return response()->json(['view'=>(String)View::make('front.products.delivery_addresses')->with(compact('deliveryAddresses'))]);
          

        }
        }
    }

