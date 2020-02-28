<?php

use App\Country;
use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::create([
            'name' => 'Кыргызстан',
        ]);

        Country::create([
            'name' => 'Россия',
        ]);

        Country::create([
            'name' => 'Казахстан',
        ]);
    }
}
