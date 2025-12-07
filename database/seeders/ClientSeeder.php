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
        Client::updateOrCreate(
            ['email' => 'cliente@tuapp.com'],
            [
                'name' => 'Cliente Principal',
                'phone' => '+573178901234',
                'address' => 'Dirección del cliente principal',
            ]
        );
    }
}
