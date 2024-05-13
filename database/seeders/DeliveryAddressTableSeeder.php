<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DeliveryAddress;

class DeliveryAddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $deliveryRecords=[
              ['id'=>1,'user_id'=>1,'name'=>'haha','address'=>'123-b','state'=>'Selangor','postcode'=>51200,'mobile'=> 1192837765,'status'=>1],
        ['id'=>2,'user_id'=>1,'name'=>'haha','address'=>'123-c','state'=>'Kuala Lumpur','postcode'=>51100,'mobile'=> 1192837764,'status'=>1]
    ];
    DeliveryAddress::insert($deliveryRecords);
    }
}
