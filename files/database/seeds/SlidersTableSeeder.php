<?php

use App\Slider;
use Illuminate\Database\Seeder;

class SlidersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Slider::create([
            'name' => 'Organic essence',
            'image' => 'sliders/slider.png',
            'description' =>
                'Скидка 15% на косметику из США <br><br> <a href="http://ecolife.loc/aktsii/rasprodazha">Успеть купить</a>',
        ]);

        Slider::create([
            'name' => 'Kosmetik essence',
            'image' => 'sliders/slider_1.png',
            'description' =>
                'Скидка 25% на продукты из США <br><br> <a href="http://ecolife.loc/aktsii/rasprodazha">Успеть купить</a>',
        ]);
    }
}
