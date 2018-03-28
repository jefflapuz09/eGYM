<?php

use Illuminate\Database\Seeder;

class TypeBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //first
        DB::table('product_types')->insert([
            'id' => 1,
            'name' => 'Water',
            'isActive' => 1 
        ]);

        DB::table('product_brands')->insert([
            'id' => 1,
            'name' => 'Alkaline',
            'isActive' => 1 
        ]);

        DB::table('product_brands')->insert([
            'id' => 2,
            'name' => 'Absolute',
            'isActive' => 1 
        ]);

        DB::table('type_brands')->insert([
            'id' => 1,
            'typeId' => 1,
            'brandId' => 1 
        ]);

        DB::table('type_brands')->insert([
            'id' => 2,
            'typeId' => 1,
            'brandId' => 2 
        ]);

        //second
        DB::table('product_types')->insert([
            'id' => 2,
            'name' => 'Powder',
            'isActive' => 1 
        ]);

        DB::table('product_brands')->insert([
            'id' => 3,
            'name' => 'Whey',
            'isActive' => 1 
        ]);

        DB::table('product_brands')->insert([
            'id' => 4,
            'name' => 'Monster',
            'isActive' => 1 
        ]);

        DB::table('type_brands')->insert([
            'id' => 3,
            'typeId' => 2,
            'brandId' => 3 
        ]);

        DB::table('type_brands')->insert([
            'id' => 4,
            'typeId' => 2,
            'brandId' => 4 
        ]);
    }
}
