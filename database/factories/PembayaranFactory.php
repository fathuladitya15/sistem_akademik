<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pembayaran>
 */
class PembayaranFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kode_pembayaran' => $this->faker->randomNumber() ,
			'nominal_pembayaran'=> "100000",
			'status_pembayaran' => "0",
			'detail_pembayaran' => "Biaya Registrasi"
        ];
    }
}