<?php

use App\Brand;
use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brand::create([
            'name' => 'Biomed',
            'brandcategory_id' => 1,
            'image' => 'brands/biomed.png',
        ]);

        Brand::create([
            'name' => 'Bisou',
            'brandcategory_id' => 1,
            'image' => 'brands/bisou.png',
        ]);

        Brand::create([
            'name' => 'Bite',
            'brandcategory_id' => 1,
            'image' => 'brands/bite.png',
        ]);

    }
}
