<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $options = [
            [
                'option_name' => 'Huevos al gusto',
                'description' => 'pueden ser motuleños, a la mexicana, tumbe he; Como se guste.',
                'ingredients' => 'Huevo y variados',
                'shift' => 'Dia',
                'id_category' => '2',
            ],
            [
                'option_name' => 'Fusilli Xcatik',
                'description' => 'Pasta fusilli con salsa xcatik.',
                'ingredients' => 'Pasta y salsa de chile xcatik',
                'shift' => 'Noche',
                'id_category' => '2',
            ],
            [
                'option_name' => 'Club Sandwich',
                'description' => '4 sandwiches con papas a la francesa',
                'ingredients' => 'jamon, queso y papas',
                'shift' => 'Ambos',
                'id_category' => '2',
            ],
            [
                'option_name' => 'Horchata',
                'description' => 'Horchata de yaxkukul',
                'ingredients' => 'Horchata y agua',
                'shift' => 'Ambos',
                'id_category' => '1',
            ],
            [
                'option_name' => 'Limonada',
                'description' => 'bebida de limon',
                'ingredients' => 'Limon, agua y azucar',
                'shift' => 'Ambos',
                'id_category' => '1',
            ],
            // Agrega más registros según sea necesario
        ];

        // Insertar los registros en la base de datos
        foreach ($options as $option) {
            DB::table('options')->insert($option);
        }
    }
}
