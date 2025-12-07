<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Order;
use App\Models\Client;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bill>
 */
class BillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $order = Order::inRandomOrder()->first();

        if (!$order) {
            return [
                'order_id' => null,
                'client_id' => null,
                'amount' => 0.00,
                'bill_date' => now(),
            ];
        }
        
        // Verificar que el cliente existe
        $client = Client::find($order->client_id);
        
        if (!$client) {
            // Si el cliente no existe, obtener uno aleatorio válido
            $client = Client::inRandomOrder()->first();
        }
        
        return [
            'order_id' => $order->id,
            'client_id' => $client ? $client->id : null,
            'amount' => $order->total,
            'bill_date' => $this->faker->date(),       
        ];
    }
}

