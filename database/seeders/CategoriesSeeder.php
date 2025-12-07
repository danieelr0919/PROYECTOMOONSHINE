<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('categories')->insert([
            ['name' => 'Pan Dulce', 'description' => 'Panes Dulces'],
            ['name' => 'Pasteles', 'description' => 'Diferentes tipos de pasteles'],
            ['name' => 'Pan Salado', 'description' => 'Panes Salados'],
            ['name' => 'Bebidas', 'description' => 'Diferentes tipos de bebidas'],
        ]);
    }
}
