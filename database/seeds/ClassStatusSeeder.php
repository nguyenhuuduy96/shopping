<?php

use Illuminate\Database\Seeder;

class ClassStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('statuses')->count()<1) {
        	$arrayName = [['name'=>'Chờ xử lý'],['name'=>'Đã xác nhận'],['name'=>'Hũy đơn hàng'],['name'=>'đơn hàng đã hoàn thành']];
        	DB::table('statuses')->insert($arrayName);
        }
    }
}
