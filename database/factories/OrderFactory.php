<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Client;
use App\Models\Product;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {   
        $product = Product::inRandomOrder()->first();
        $client = Client::inRandomOrder()->first();

        $quantity = $this->faker->numberBetween(1, 5);

        $total = $product ? ($product->price * $quantity): 0;

        return [
            //
            'client_id' => $client->id ?? Client::all()->random()->id,
            'product_id' => $product->id ?? Product::all()->random()->id,
            'quantity' => $quantity,
            'total' => $total,
            'order_date' =>$this->faker->date(),
            'status' =>$this->faker->randomElement(['pendiente', 'confirmado', 'enviado', 'entregado', 'cancelado']),
        ];
    }
}

