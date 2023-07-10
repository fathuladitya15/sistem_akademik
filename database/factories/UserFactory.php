<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => $this->faker->name(),
			"email" => $this->faker->unique()->safeEmail(),
			"username" => $this->faker->unique()->username(),
			"password" => Hash::make('password'),
			"role" => $this->faker->randomElement(['siswa','guru']),
			"status_akun" => 1,
        ];
    }
}
