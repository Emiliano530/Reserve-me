<?php

namespace Database\Seeders;

use App\Models\Table;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            $tables = [
                [
                    'table_number' => 1,
                    'guestNumber' => 2,
                    'id_area' => 1,
                ],
                [
                    'table_number' => 2,
                    'guestNumber' => 2,
                    'id_area' => 1,
                ],
                [
                    'table_number' => 3,
                    'guestNumber' => 3,
                    'id_area' => 1,
                ],
                [
                    'table_number' => 4,
                    'guestNumber' => 3,
                    'id_area' => 1,
                ],
                [
                    'table_number' => 5,
                    'guestNumber' => 3,
                    'id_area' => 1,
                ],
                [
                    'table_number' => 1,
                    'guestNumber' => 4,
                    'id_area' => 2,
                ],
                [
                    'table_number' => 2,
                    'guestNumber' => 4,
                    'id_area' => 2,
                ],
                [
                    'table_number' => 3,
                    'guestNumber' => 4,
                    'id_area' => 2,
                ],
                [
                    'table_number' => 4,
                    'guestNumber' => 2,
                    'id_area' => 2,
                ],
                [
                    'table_number' => 5,
                    'guestNumber' => 2,
                    'id_area' => 2,
                ],
                [
                    'table_number' => 6,
                    'guestNumber' => 2,
                    'id_area' => 2,
                ],
                [
                    'table_number' => 7,
                    'guestNumber' => 4,
                    'id_area' => 2,
                ],
                [
                    'table_number' => 8,
                    'guestNumber' => 6,
                    'id_area' => 2,
                ],
                [
                    'table_number' => 9,
                    'guestNumber' => 6,
                    'id_area' => 2,
                ],
                [
                    'table_number' => 1,
                    'guestNumber' => 4,
                    'id_area' => 3,
                ],
                [
                    'table_number' => 2,
                    'guestNumber' => 4,
                    'id_area' => 3,
                ],
                [
                    'table_number' => 3,
                    'guestNumber' => 3,
                    'id_area' => 3,
                ],
                [
                    'table_number' => 4,
                    'guestNumber' => 3,
                    'id_area' => 3,
                ],
                // Agrega más registros según sea necesario
            ];
    
            // Insertar los registros en la base de datos
            foreach ($tables as $table) {
                DB::table('tables')->insert($table);
            }
    }
}
