<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->firstName(),
            'lastName' => fake()->lastName(),
            'email' => fake()->email(),
            'password' => 'password', // password
            'phone' => fake()->phoneNumber(),
            'birthday' => fake()->date(),
            'role' => '2',
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
}
