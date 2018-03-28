<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon as Carbon;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('suppliers')->insert([
            'id' => '1',
            'name' => 'Rudys Fitness',
            'street' => '2844 Int. 19 Aurora Blvd.',
            'brgy' => 'Sta.cruz',
            'city' => 'Manila',
            'contactNumber' => '0999999999',
            'isActive' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('suppliers')->insert([
            'id' => '2',
            'name' => 'AIMS',
            'street' => '#25 Malakas St.',
            'brgy' => 'Sta.cruz',
            'city' => 'Manila',
            'contactNumber' => '0999999999',
            'isActive' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

    }
}
