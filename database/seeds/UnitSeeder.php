<?php

use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('uoms')->insert([
            'id' => 1,
            'name' => 'g',
            'category' => 'Mass',
            'description' => 'Gram',
            'isActive' => 1
        ]);

        DB::table('uoms')->insert([
            'id' => 2,
            'name' => 'ml',
            'category' => 'Volume',
            'description' => 'Milliter',
            'isActive' => 1
        ]);
    }
}
