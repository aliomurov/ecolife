<?php

use App\Brandcategory;
use Illuminate\Database\Seeder;

class BrandcategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brandcategory::create([
            'name' => 'Продукты',
        ]);

        Brandcategory::create([
            'name' => 'Косметика',
        ]);

        Brandcategory::create([
            'name' => 'Ароматерапия',
        ]);

        Brandcategory::create([
            'name' => 'Для дома',
        ]);

        Brandcategory::create([
            'name' => 'Для здоровья',
        ]);
    }
}
