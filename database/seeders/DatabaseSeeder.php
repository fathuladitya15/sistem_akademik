<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\DataSiswa;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

		$this->call([
			UsersTableSeeder::class,
			SettingSeeder::class,
			JurusanSeeder::class,
		]);
		User::factory(300)->has(DataSiswa::factory())->create();
    }
}
