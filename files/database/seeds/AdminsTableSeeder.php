<?php

use App\Admin;
use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name' => 'Админ',
            'email' => 'admin@mail.ru',
            'password' => bcrypt(123456789),
        ]);
    }
}
