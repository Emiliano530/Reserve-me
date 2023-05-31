<?php

namespace Database\Factories;

use App\Models\Option;
use Illuminate\Database\Eloquent\Factories\Factory;

class PackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $options = Option::inRandomOrder()->take(3)->pluck('option_name')->toArray();
        $serializedOptions = serialize($options);
        return [
            'package_name' => fake()->word(),
            'description' => fake()->sentence(),
            'options' => $serializedOptions,
            'priceXguest' => fake()->randomElement([125, 200, 250]),
        ];
    }
}
