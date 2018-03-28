<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'id' => 1,
            'name' => 'Whey Powder 30 g',
            'price' => '1250.00',
            'typeId' => 2,
            'brandId' => 3,
            'variantId' => 1,
            'reorder' => 10,
            'isActive' => 1
        ]);

        DB::table('products')->insert([
            'id' => 2,
            'name' => 'Absolute Water 30 ml',
            'price' => '10.00',
            'typeId' => 1,
            'brandId' => 2,
            'variantId' => 2,
            'reorder' => 10,
            'isActive' => 1
        ]);
    }
}
