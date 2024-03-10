<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VendorsBusinessDetail;

class VendorsBusinessDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendorRecords=[
            ['id'=>1,'vendor_id'=>1,'shop_name'=>'Haha Art Store','shop_state'=>'Selangor','shop_mobile'=>'1234567890','shop_website'=>'','shop_email'=>'haha@haha.com'],
        ];
        VendorsBusinessDetail::insert($vendorRecords);
    }
}
