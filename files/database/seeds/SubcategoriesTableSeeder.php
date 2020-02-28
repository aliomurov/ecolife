<?php

use App\Subcategory;
use Illuminate\Database\Seeder;

class SubcategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Акции категория 1
        Subcategory::create([
            'name' => 'Распродажа',
            'category_id' => 1,
        ]);

        Subcategory::create([
            'name' => 'Акции и предложения',
            'category_id' => 1,
        ]);

        Subcategory::create([
            'name' =>'Масленица',
            'category_id' => 1,
        ]);

        Subcategory::create([
            'name' => 'Зимний уход',
            'category_id' => 1,
        ]);

        Subcategory::create([
            'name' => 'Доступная органика',
            'category_id' => 1,
        ]);

        Subcategory::create([
            'name' => 'Все до 100 сомов',
            'category_id' => 1,
        ]);

        Subcategory::create([
            'name' => 'Нарушенная упаковка',
            'category_id' => 1,
        ]);

        Subcategory::create([
            'name' => 'Истекающие сроки',
            'category_id' => 1,
        ]);

        Subcategory::create([
            'name' => 'Beauty',
            'category_id' => 1,
        ]);

        // Продукты категория 2
        Subcategory::create([
            'name' => 'Полезный завтрак',
            'category_id' => 2,
        ]);

        Subcategory::create([
            'name' => 'Гарниры',
            'category_id' => 2,
        ]);

        Subcategory::create([
            'name' => 'Здоровый перекус',
            'category_id' => 2,
        ]);

        Subcategory::create([
            'name' => 'Сладости',
            'category_id' => 2,
        ]);

        Subcategory::create([
            'name' => 'Мука, отруба',
            'category_id' => 2,
        ]);

        Subcategory::create([
            'name' => 'Семена, проращивание',
            'category_id' => 2,
        ]);

        Subcategory::create([
            'name' => 'Хлебные изделия',
            'category_id' => 2,
        ]);

        Subcategory::create([
            'name' => 'Блюда быстрого приготовления',
            'category_id' => 2,
        ]);

        Subcategory::create([
            'name' => 'Закваски',
            'category_id' => 2,
        ]);

        Subcategory::create([
            'name' => 'Масла, уксусы, соусы',
            'category_id' => 2,
        ]);

        Subcategory::create([
            'name' => 'Специи, приправы',
            'category_id' => 2,
        ]);

        Subcategory::create([
            'name' => 'Консервация',
            'category_id' => 2,
        ]);

        Subcategory::create([
            'name' => 'Напитки',
            'category_id' => 2,
        ]);

        Subcategory::create([
            'name' => 'Чай, кофе, какао',
            'category_id' => 2,
        ]);

        Subcategory::create([
            'name' => 'Сахар и сахарозаменители',
            'category_id' => 2,
        ]);

        Subcategory::create([
            'name' => 'Суперфуды',
            'category_id' => 2,
        ]);

        Subcategory::create([
            'name' => 'Детское питание',
            'category_id' => 2,
        ]);

        //Косметика категория 3
        Subcategory::create([
            'name' => 'Для лица',
            'category_id' => 3,
        ]);

        Subcategory::create([
            'name' => 'Для волос',
            'category_id' => 3,
        ]);

        Subcategory::create([
            'name' => 'Для тела',
            'category_id' => 3,
        ]);

        Subcategory::create([
            'name' => 'Декоративная косметика',
            'category_id' => 3,
        ]);

        Subcategory::create([
            'name' => 'Для детей',
            'category_id' => 3,
        ]);

        Subcategory::create([
            'name' => 'Для мужчин',
            'category_id' => 3,
        ]);

        //Ароматерапия категория 4
        Subcategory::create([
            'name' => 'Эфирные масла',
            'category_id' => 4,
        ]);

        Subcategory::create([
            'name' => 'Косметические масла',
            'category_id' => 4,
        ]);

        Subcategory::create([
            'name' => 'Аромалампы',
            'category_id' => 4,
        ]);

        Subcategory::create([
            'name' => 'Аромакосметика',
            'category_id' => 4,
        ]);

        Subcategory::create([
            'name' => 'Ароматизаторы',
            'category_id' => 4,
        ]);

        Subcategory::create([
            'name' => 'Свечи',
            'category_id' => 4,
        ]);

        Subcategory::create([
            'name' => 'Аксессуары для ароматерапии',
            'category_id' => 4,
        ]);
    }
}
