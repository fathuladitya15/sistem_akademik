<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
		User::create([
			'name' 		=> 'MUHAMAD FATHUL ADITYA',
			'email' 	=> 'muhamadfathuladitya15@gmail.com',
			'username' 	=> 'admin',
			'status_akun' => 1,
			'role'		=> 'admin',
			'password'  => Hash::make("password"),  
		]);
    }
}
