<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Акции',
        ]);

        Category::create([
            'name' => 'Продукты',
        ]);

        Category::create([
            'name' => 'Косметика',
        ]);

        Category::create([
            'name' => 'Ароматерапия',
        ]);

        Category::create([
            'name' => 'Для дома',
        ]);

        Category::create([
            'name' => 'Для здоровья',
        ]);

        Category::create([
            'name' => 'Прочее',
        ]);
    }
}
