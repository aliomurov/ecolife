<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategoriesTableSeeder::class);
        $this->call(BrandcategoriesTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(AdminsTableSeeder::class);
        $this->call(SubcategoriesTableSeeder::class);
        $this->call(CategoryproductsTableSeeder::class);
        $this->call(SlidersTableSeeder::class);
        $this->call(BlogsTableSeeder::class);
        $this->call(BrandsTableSeeder::class);
    }
}
