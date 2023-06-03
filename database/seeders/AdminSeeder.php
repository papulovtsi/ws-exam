<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Создаем дефолтного юзера администратора
        User::create([
           "name" => "Admin",
           "surname" => "Admin",
           "patronymic" => "",
           "email" => "admin@wsr.ru",
           "login" => "admin",
           "role" => "admin",
           "password" => Hash::make("admin11"),
        ]);
    }
}
