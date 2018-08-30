<?php

use Illuminate\Database\Seeder;

class CreateProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('products')->insert([
        	['name'=>'Cream cake','product_id'=>'KM0001','category_id'=>'1','website_id'=>'1','attribute'=>'small','price'=>5,'stock'=>1,'weight'=>3],
        	['name'=>'Food VietNam','product_id'=>'KM0002','category_id'=>'1','website_id'=>'1','attribute'=>'small','price'=>4,'stock'=>1,'weight'=>1],
        	['name'=>'PHP','category_id'=>'2','product_id'=>'KM0003','website_id'=>'2','attribute'=>'small','price'=>2,'stock'=>1,'weight'=>1]
        	
        ]);
    }
}
