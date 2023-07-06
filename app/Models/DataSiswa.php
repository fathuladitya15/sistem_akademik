<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSiswa extends Model
{
    use HasFactory;
	
	protected $table  = 'table_data_siswa';

	protected $fillable = ['user_id','nis','jenis_kelamin','tempat_lahir','tanggal_lahir','alamat','nomer_telepon','hobby','provinsi_code','kota_code','district_code','villages_code','jurusan_id','jurusan_opsi_id','kelas','tahun_ajaran','nilai_rata'];
}
