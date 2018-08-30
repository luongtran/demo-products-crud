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
        $this->call(CreateCategorySeeder::class);
       $this->call(CreateWebsiteSeeder::class);
        $this->call(CreateProductSeeder::class);
    
    }
}