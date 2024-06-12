<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rating;

class RatingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ratingRecords=[
            ['id'=>1,'user_id'=>1,'product_id'=>15,'review'=>'Its is good','rating'=>4,'status'=>1],
            ['id'=>2,'user_id'=>1,'product_id'=>16,'review'=>'Its is nice','rating'=>5,'status'=>1],
           
        ];
        Rating::insert($ratingRecords);
    }
}
