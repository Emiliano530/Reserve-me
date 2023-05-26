<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'category_name' => 'Comidas',
            ],
            [
                'category_name' => 'Cafes',
            ],
            [
                'category_name' => 'Postres',
            ],
            [
                'category_name' => 'Panes',
            ],
            [
                'category_name' => 'Bebidas',
            ],
            // Agrega más registros según sea necesario
        ];

        // Insertar los registros en la base de datos
        foreach ($categories as $category) {
            DB::table('categories')->insert($category);
        }
    }
}
