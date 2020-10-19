<?php

use Illuminate\Database\Seeder;

class ClassDecentralization extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('decentralizations')->count()<1) {
        	$arrayName = [['name'=>'Thành viên'],['name'=>'Admin quản lý'],['name'=>'Supper Admin']];
        	DB::table('decentralizations')->insert($arrayName);
        }
    }
}
