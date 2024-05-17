<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Models\DeliveryAddress;
use App\Http\Controllers\Controller;
use Auth;
use Validator;
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
            $validator=Validator::make($request->all(),[
               'delivery_name'=>'required|string|max:100',
               'delivery_address'=>'required|string|max:100',
               'delivery_state'=>'required|string|max:100',
               'delivery_postcode'=>'required|string||numeric|digits:5',
               'delivery_mobile'=>'required|numeric|digits:10',
            ]);
            if($validator->passes()){
                $data=$request->all();
                // echo "<pre>";print_r($data);die;
                $address=array();
                $address['user_id']=Auth::user()->id;
                $address['name']=$data['delivery_name'];
                $address['address']=$data['delivery_address'];
                $address['state']=$data['delivery_state'];
                $address['postcode']=$data['delivery_postcode'];
                $address['mobile']=$data['delivery_mobile'];
                $address['status']=1;
     
                if(!empty($data['delivery_id'])){
                  //edit delivery address
                  DeliveryAddress::where('id',$data['delivery_id'])->update($address);
                }else{
                // $address['status']=1;
                 //add delivery address
                 DeliveryAddress::create($address);
             }
                 $deliveryAddresses=DeliveryAddress::deliveryAddresses();
                return response()->json(['view'=>(string)View::make('front.products.delivery_addresses')->with(compact('deliveryAddresses'))
             ]);
            }else{
                return response()->json(['type'=>'error','errors'=>$validator->messages()]);
            }
           
          
        }

        }
        public function removeDeliveryAddress(Request $request){
            if($request->ajax()){
                $data=$request->all();
               // echo "<pre>";print_r($data);die;
               DeliveryAddress::where('id',$data['addressid'])->delete();
               $deliveryAddresses=DeliveryAddress::deliveryAddresses();
               return response()->json(['view'=>(string)View::make('front.products.delivery_addresses')->with(compact('deliveryAddresses'))
            ]);  
        }
    }
}
