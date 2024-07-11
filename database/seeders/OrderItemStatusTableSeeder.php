<?php

namespace Database\Seeders;

use App\Models\OrderItemStatus;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderItemStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orderItemStatusRecords=[
            ['id'=>1,'name'=>'Pending','status'=>1],
            ['id'=>2,'name'=>'In Process','status'=>1],
            ['id'=>3,'name'=>'Shipped','status'=>1],
            ['id'=>4,'name'=>'Delivered','status'=>1],
        ];
         OrderItemStatus::insert($orderItemStatusRecords);
    }
}
