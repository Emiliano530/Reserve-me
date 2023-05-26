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
                'price' => '125.00',
                'shift' => 'Dia',
                'id_category' => '1',
            ],
            [
                'option_name' => 'Fusilli Xcatik',
                'description' => 'Pasta fusilli con salsa xcatik.',
                'ingredients' => 'Pasta y salsa de chile xcatik',
                'price' => '125.00',
                'shift' => 'Noche',
                'id_category' => '1',
            ],
            [
                'option_name' => 'Club Sandwich',
                'description' => '4 sandwiches con papas a la francesa',
                'ingredients' => 'jamon, queso y papas',
                'price' => '125.00',
                'shift' => 'Ambos',
                'id_category' => '1',
            ],
            [
                'option_name' => 'Horchata',
                'description' => 'Horchata de yaxkukul',
                'ingredients' => 'Horchata y agua',
                'price' => '125.00',
                'shift' => 'Ambos',
                'id_category' => '5',
            ],
            [
                'option_name' => 'Limonada',
                'description' => 'bebida de limon',
                'ingredients' => 'Limon, agua y azucar',
                'price' => '125.00',
                'shift' => 'Ambos',
                'id_category' => '5',
            ],
            [
                'option_name' => 'Capucchino',
                'description' => 'cafe con espuma',
                'ingredients' => 'cafe, leche',
                'price' => '45.00',
                'shift' => 'Ambos',
                'id_category' => '2',
            ],
            [
                'option_name' => 'Macchiato',
                'description' => 'cafe con espuma de leche',
                'ingredients' => 'cafe, leche',
                'price' => '46.00',
                'shift' => 'Ambos',
                'id_category' => '2',
            ],
            [
                'option_name' => 'Flan',
                'description' => 'delicioso flan natural',
                'ingredients' => 'huevo, vainilla',
                'price' => '35.00',
                'shift' => 'Ambos',
                'id_category' => '3',
            ],
            [
                'option_name' => 'Pay de queso',
                'description' => 'pay hecho a base de queso',
                'ingredients' => 'queso',
                'price' => '35.00',
                'shift' => 'Ambos',
                'id_category' => '3',
            ],
            [
                'option_name' => 'Rol de canela',
                'description' => 'pan en rollo con crema dulce',
                'ingredients' => 'crema',
                'price' => '35.00',
                'shift' => 'Ambos',
                'id_category' => '4',
            ],
            [
                'option_name' => 'Empanada de queso philadelfia',
                'description' => 'empanada de pan rellena de queso philadelfia',
                'ingredients' => 'queso philadelfia',
                'price' => '20.00',
                'shift' => 'Ambos',
                'id_category' => '4',
            ],
            // Agrega más registros según sea necesario
        ];

        // Insertar los registros en la base de datos
        foreach ($options as $option) {
            DB::table('options')->insert($option);
        }
    }
}
