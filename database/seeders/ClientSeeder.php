<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Client;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Client::factory()->create([
            'name' => 'Cliente ',
            'email' => 'cliente1@example.com',
            'phone' => '+573178901234',
            'address' => 'Dirección del cliente 1',
        ]);
        Client::factory(10)->create();
    }
}
