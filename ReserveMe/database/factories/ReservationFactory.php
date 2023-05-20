<?php

namespace Database\Factories;

use App\Models\Table;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;


class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $table = Table::inRandomOrder()->first();
        $user = User::inRandomOrder()->first();
        return [
            'guest_number' => fake()->randomElement([2, 4, 6]),
            'reservation_datetime' => fake()->dateTime(),
            'reservation_status' => fake()->randomElement(['Completada','Cancelada','Pendiente']),
            'reference_name' => fake()->name(),
            'associated_event' => fake()->randomElement(['Cumpleaños','Aniversario',NULL]),
            'extras' => fake()->randomElement(['Flores','Velas','Pastel',NULL]),
            'payment_status' => fake()->randomElement(['Pagado','Pendiente']),
            'id_table' => $table->id,
            'id_user' => $user->id,
        ];
    }
}
