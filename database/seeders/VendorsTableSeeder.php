<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vendor;

class VendorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendorRecords=[
            ['id'=>1,'name'=>'Haha','state'=>'Selangor','mobile'=>'1234567890','email'=>'haha@haha.com','current_status'=>'looking for job','status'=>0],];
        Vendor::insert($vendorRecords);
    }
}
