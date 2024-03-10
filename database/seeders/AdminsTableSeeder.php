<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRecords=[
            ['id'=>1,'name'=>'Lau','type'=>'superadmin','vendor_id'=>0,'mobile'=>'9999999999','email'=>'admin@admin.com','password'=>'$2a$12$0NBJP0H.PXgoIZj55T9D6uzgEvRrAcJFpGnJ3UOXM2jP17qyJ3Rga','image'=>'','status'=>1],
            ['id'=>2,'name'=>'Haha','type'=>'vendor','vendor_id'=>1,'mobile'=>'1234567890','email'=>'haha@haha.com','password'=>'$2a$12$W4.YOgh4zXVK/byLGWTIx.iaE2W1tQYxqQ2xjnn/fNd6lJPFrqeV6','image'=>'','status'=>0],
           
        ];
        Admin::insert($adminRecords);
    }
}
