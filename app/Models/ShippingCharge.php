<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShippingCharge extends Model
{
    use HasFactory;

    public static function getShippingCharges($total_weight, $state)
    {
        $shippingDetail = self::where('state', $state)->first();
    
        if (!$shippingDetail) {
            // No shipping detail found for the state
            return null; // Or a default shipping charge
        }
    
        $shippingDetailArray = $shippingDetail->toArray();
    
        $rate_key = match(true) {
            $total_weight <= 500 => '0_500g',
            $total_weight <= 1000 => '501_1000g',
            $total_weight <= 2000 => '1001_2000g',
            $total_weight <= 5000 => '2001_5000g',
            $total_weight > 5000 => 'above_5000g',
            default => null
        };
    
        $rate = 0;
    
        if ($rate_key) {
            $rate = $shippingDetailArray[$rate_key] ?? 0; // Default to 0 if key not found
        }
    
        return $rate;
    }
        // if ($total_weight > 0) {
        //     if ($total_weight > 0 && $total_weight <= 500) {
        //         $rate = $shippingDetails['0_500g'];
        //     } else if ($total_weight > 500 && $total_weight <= 1000) {
        //         $rate = $shippingDetails['501_1000g'];
        //     } else if ($total_weight > 1000 && $total_weight <= 2000) {
        //         $rate = $shippingDetails['1001_2000g'];
        //     } else if ($total_weight > 2000 && $total_weight <= 5000) {
        //         $rate = $shippingDetails['2001_5000g'];
        //     } else if ($total_weight > 5000) {
        //         $rate = $shippingDetails['above_5000g'];
        //     }
        // } else {
        //     $rate = 0;
        // }
   
}
