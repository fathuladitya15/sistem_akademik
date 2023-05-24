<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;
use DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

		// $arr = [ 'name' => 'nama_aplikasi', 'value' => 'Sistem Informasi Akademik'],
		// [ 'name' => 'logo_aplikasi','value' => 'imageassets/media/logos/logo-1-dark.svg'],
		// ['name' => 'nama_sekolah','value' => 'SMK PANDU JAYA 0']

		$arr  = array(
			array('name' => 'nama_aplikasi','value' => 'Sistem Informasi Akademik' ),
			array('name' => 'logo_aplikasi','value' => 'assets/media/logos/logo-1-dark.svg' ),
			array('name' => 'nama_sekolah','value' => 'SMK PANDU JAYA 0' ),
			array('name' => 'nomer_telepon_sekolah','value' => '021 889 225' ),
			array('name' => 'email_sekolah','value' => 'sekolahkita@gmail.com' ),
			array('name' => 'link_facebook','value' => 'https://facebook.com' ),
			array('name' => 'link_instagram','value' => 'https://instagram.com' ),
			array('name' => 'link_twitter','value' => 'https://twitter.com' ),
		);
		Setting::insert($arr);
    }
}
