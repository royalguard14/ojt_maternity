<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendant>
 */
class AttendantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
          return [
        'name' => $this->faker->name,
        'position' => $this->faker->jobTitle,
        'address' => $this->faker->address,
    ];
    }
}
