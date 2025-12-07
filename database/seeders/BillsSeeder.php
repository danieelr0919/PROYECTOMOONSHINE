<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Bill;
use App\Models\Order;
use App\Models\Client;
class BillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $orders = Order::all();
        $orderids = Order::pluck('id');


        $clientids = Client::pluck('id');

        if ($orderids->isEmpty() || $clientids->isEmpty()) {
            echo "No hay ordenes de ningun cliente para realizar la factura.";
            return;
        }

        $orderExample = $orders->random();
        

        Bill::create([
            'order_id' => $orderExample->id,
            'client_id' => $orderExample->client_id,
            'amount' => $orderExample->total,
            'bill_date' => now(),
        ]);

        Bill::factory(49)->create();
    }
}