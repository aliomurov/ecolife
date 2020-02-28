<?php

use App\Categoryproduct;
use Illuminate\Database\Seeder;

class CategoryproductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categoryproduct::create([
            'name' => 'Каши',
            'subcategory_id' => 10,
            'category_id' => 2,
        ]);

        Categoryproduct::create([
            'name' => 'Хлопья',
            'subcategory_id' => 10,
            'category_id' => 2,
        ]);

        Categoryproduct::create([
            'name' => 'Мюсли',
            'subcategory_id' => 10,
            'category_id' => 2,
        ]);

        Categoryproduct::create([
            'name' => 'Гранола',
            'subcategory_id' => 10,
            'category_id' => 2,
        ]);

        Categoryproduct::create([
            'name' => 'Бобовые',
            'subcategory_id' => 11,
            'category_id' => 2,
        ]);

        Categoryproduct::create([
            'name' => 'Злаки',
            'subcategory_id' => 11,
            'category_id' => 2,
        ]);

        Categoryproduct::create([
            'name' => 'Крупы',
            'subcategory_id' => 11,
            'category_id' => 2,
        ]);

        Categoryproduct::create([
            'name' => 'Макароны',
            'subcategory_id' => 11,
            'category_id' => 2,
        ]);
    }
}
