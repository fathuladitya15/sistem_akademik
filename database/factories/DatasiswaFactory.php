<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Jurusan;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DataSiswa>
 */
class DatasiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "nis" 				=> $this->faker->randomDigit(),
			"jenis_kelamin" 	=> $this->faker->randomElement(["L","P"]),
			"tanggal_lahir" 	=> $this->faker->dateTime()->format("Y-m-d"),
			"alamat" 			=> $this->faker->address(),
			"nomer_telepon" 	=> $this->faker->phoneNumber(),
			"jurusan_id" 		=> Jurusan::all()->random()->id,
			"jurusan_opsi_id" 	=> Jurusan::all()->random()->id,
			"tahun_ajaran" 		=> tahun_ajaran('baru'), // FAKER TAHUN AJARAN BISA DIGANTI MANUAL BERDASARKAN ANGKATAN
			"nilai_rata" 		=> rand(10,99).'.'.rand(1,9)

        ];
    }
}
