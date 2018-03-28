<?php

use Illuminate\Database\Seeder;

class VariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_variants')->insert([
            'id' => 1,
            'category' => 'Mass',
            'size' => '30 g',
            'isActive' => 1
        ]);

        DB::table('type_variants')->insert([
            'id' => 1,
            'typeId' => 2,
            'variantId' => 1,
        ]);

        DB::table('product_variants')->insert([
            'id' => 2,
            'category' => 'Volume',
            'size' => '30 ml',
            'isActive' => 1
        ]);

        DB::table('type_variants')->insert([
            'id' => 2,
            'typeId' => 1,
            'variantId' => 2,
        ]);
    }
}
