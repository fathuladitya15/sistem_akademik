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
		User::factory(10)->has(DataSiswa::factory())->create();
		

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
