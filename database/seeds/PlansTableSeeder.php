<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('plans')->insert([
            'name' => 'basic',
            'description' => 'The basic plan allows you to create 1 course with unlimited students'
        ]);

        DB::table('plans')->insert([
            'name' => 'plus',
            'description' => 'The basic plan allows you to create 5 courses with unlimited students'
        ]);

        DB::table('plans')->insert([
            'name' => 'premium',
            'description' => 'The basic plan allows you to create unlimited courses with unlimited students'
        ]);
    }
}
