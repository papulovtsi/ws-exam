<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Создаем стандартные категории, указанные в ТЗ
        $categories = [
            "лазерные принтеры",
            "струйные принтеры",
            "термопринтеры",
        ];

        foreach ($categories as $category) {
            Category::create(["name" => $category]);
        }
    }
}
