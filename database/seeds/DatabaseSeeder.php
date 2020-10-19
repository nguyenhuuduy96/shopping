<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call(ClassColorSeeder::class);
        $this->call(ClassStatusSeeder::class);
        $this->call(ClassDecentralization::class);
    }
}
