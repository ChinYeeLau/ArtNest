<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Banner;

class BannersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bannerRecords=[
            ['id'=>1,'image'=>'banner-1.jpg','link'=>'https://techademycampus.com','title'=>'Techademy','alt'=>'Techademy','status'=>1],
            ['id'=>2,'image'=>'banner-2.jpg','link'=>'https://www.nimp2030.gov.my','title'=>'NIMP2030','alt'=>'NIMP2030','status'=>1]
        ];
        Banner::insert($bannerRecords);
    }
}
