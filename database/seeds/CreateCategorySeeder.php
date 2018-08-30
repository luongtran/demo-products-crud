<?php

use Illuminate\Database\Seeder;

class CreateCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
        	['parent_id'=>1,'name'=>'Foody'],
        	['parent_id'=>1,'name'=>'Internet'],
        	
        ]);
    }
}
