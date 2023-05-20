<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $areas = [
            [
                'area_name' => 'Cafeteria',
            ],
            [
                'area_name' => 'Comedor',
            ],
            [
                'area_name' => 'Salon',
            ],
            // Agrega más registros según sea necesario
        ];

        // Insertar los registros en la base de datos
        foreach ($areas as $area) {
            DB::table('areas')->insert($area);
        }
    }
}
