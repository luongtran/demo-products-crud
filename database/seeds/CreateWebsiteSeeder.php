<?php

use Illuminate\Database\Seeder;

class CreateWebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('websites')->insert([
        	['name'=>'SFR software'],
        	['name'=>'IT company'],
        	
        ]);
    }
}
