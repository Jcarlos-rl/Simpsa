<?php

use App\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brand = Brand::create([
            'name' => 'BGS',
            'discount' => 10
        ]);

        $brand2 = Brand::create([
            'name' => 'URREA',
            'discount' => 10
        ]);

        $brand3 = Brand::create([
            'name' => 'SURTEK',
            'discount' => 10
        ]);
    }
}
