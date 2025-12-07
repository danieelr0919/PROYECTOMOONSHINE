<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::updateOrCreate(
            ['name' => 'Pan Dulce'],
            ['description' => 'Panes Dulces']
        );

        Category::updateOrCreate(
            ['name' => 'Pasteles'],
            ['description' => 'Diferentes tipos de pasteles']
        );

        Category::updateOrCreate(
            ['name' => 'Pan Salado'],
            ['description' => 'Panes Salados']
        );

        Category::updateOrCreate(
            ['name' => 'Bebidas'],
            ['description' => 'Diferentes tipos de bebidas']
        );

        Category::updateOrCreate(
            ['name' => 'Postres'],
            ['description' => 'Postres y dulces']
        );
    }
}
