<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(SupplierSeeder::class);
        $this->call(TypeBrandSeeder::class);
        $this->call(UnitSeeder::class);
        $this->call(VariantSeeder::class);
        $this->call(ProductSeeder::class);
    }
}
