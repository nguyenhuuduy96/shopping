<?php

use Illuminate\Database\Seeder;

class ClassColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('colors')->count()<1) {
        	$arrayName = [['name'=>'blue','slug'=>'blue-01'],['name'=>'white','slug'=>'white-01'],['name'=>'red','slug'=>'red-01'],['name'=>'green','slug'=>'green-01']];
        	DB::table('colors')->insert($arrayName);
        }
    }
}
