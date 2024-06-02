<?php

namespace App\Models;

use App\Models\ShippingCharge;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShippingCharge extends Model
{
    use HasFactory;

    public static function getShippingCharges($total_weight,$state){
        $shippingDetails=ShippingCharge::where('state',$state)->first()->toArray();
        if($total_weight>0){
         if($total_weight>0 && $total_weight<=500){
            $rate=$shippingDetails['0_500g'];
         }else if($total_weight>500 && $total_weight<=1000){
            $rate=$shippingDetails['501_1000g'];
         }else if($total_weight>1000 && $total_weight<=2000){
            $rate=$shippingDetails['1001_2000g'];
        }else if($total_weight>2000 && $total_weight<=5000){
            $rate=$shippingDetails['2001_5000g'];
        }else if($total_weight>5000){
            $rate=$shippingDetails['above_5000g'];
        }    
        }else{
            $rate=0;
        }
        return $rate;
    }
}
