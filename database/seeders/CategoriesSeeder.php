<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Pan Dulce', 'description' => 'Panes Dulces', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Pasteles', 'description' => 'Diferentes tipos de pasteles', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Salados', 'description' => 'Panes Salados', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Bebidas', 'description' => 'Diferentes tipos de bebidas', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Postres', 'description' => 'Postres y dulces', 'created_at' => now(), 'updated_at' => now()],
        ];

        foreach ($categories as $category) {
            if (!DB::table('categories')->where('name', $category['name'])->exists()) {
                DB::table('categories')->insert($category);
            }
        }
    }
}
