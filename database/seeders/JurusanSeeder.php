<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Jurusan;


class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arr = [
			['nama_jurusan' => "Rekayasa Perangkat Lunak", "deskripsi_jurusan" => "Lorem Ipsum", "singkatan_jurusan" => "RPL"],
			['nama_jurusan' => "Teknik Jaringan dan Komputer", "deskripsi_jurusan" => "Lorem Ipsum", "singkatan_jurusan" => "TKJ"],
			['nama_jurusan' => "Multimedia", "deskripsi_jurusan" => "Lorem Ipsum", "singkatan_jurusan" => "MM"],
		];

		Jurusan::insert($arr);
    }
}
