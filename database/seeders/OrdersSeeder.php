<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Client;
use App\Models\Product;
class ordersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener los IDs de los clientes y productos
        $clientIds = Client::pluck('id');
        $productIds = Product::pluck('id');

        // Verificar si hay clientes o productos disponibles
        if ($clientIds->isEmpty() || $productIds->isEmpty()) {
            echo "No hay clientes o productos disponibles para crear pedidos.";
            return;
        }

        // Crear un pedido de ejemplo
        Order::create([
            'client_id' => $clientIds->random(),
            'product_id' => $productIds->random(),
            'quantity' => 1,
            'total' => 100.00,
            'order_date' => now(),
            'status' => 'confirmado',
        ]);

        // Crear 50 pedidos aleatorios
        Order::factory(50)->create();

    }
}
