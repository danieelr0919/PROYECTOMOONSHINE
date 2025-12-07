<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Verificar que existe la categoría con ID 1
        if (!Category::find(1)) {
            echo "Error: La categoría con ID 1 no existe. Ejecuta CategoriesSeeder primero.";
            return;
        }

        Product::updateOrCreate(
            ['name' => 'Pan de la Casa'],
            [
                'description' => 'Especialidad de la panadería',
                'price' => 100.00,
                'stock' => 100,
                'category_id' => 1,
            ]
        );

        Product::updateOrCreate(
            ['name' => 'Pastel de Chocolate'],
            [
                'description' => 'Pastel de chocolate artesanal',
                'price' => 250.00,
                'stock' => 50,
                'category_id' => 1,
            ]
        );

        Product::updateOrCreate(
            ['name' => 'Pan Integral'],
            [
                'description' => 'Pan integral saludable',
                'price' => 80.00,
                'stock' => 75,
                'category_id' => 1,
            ]
        );
    }
}
