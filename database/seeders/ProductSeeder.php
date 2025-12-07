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
        //
        // Obtener los IDs de las categorias
        $categoryIds = Category::pluck('id');

        // Verificar si hay categorias disponibles
        if ($categoryIds->isEmpty()) {
            echo "No hay categorias disponibles para crear productos.";
            return;
        }

        // Crear un producto de ejemplo
        Product::create([
            'name' => 'Pan de la Casa',
            'description' => 'Especialidad de la panaderia',
            'price' => 100.00,
            'stock' => 100,
            'category_id' => $categoryIds->random(),
        ]);

        // Crear 10 productos aleatorios
        Product::factory(10)->create([
            'category_id' => $categoryIds->random(),
        ]);

    }
}
