<?php

namespace App\Http\Controllers;

use DB;
use App\Models\User;
use App\Models\DataSiswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    function index(Request $request)  {
		
		$pageTitle 		= 'Data Semua siswa';
		$SubPageTitle 	= 'Data Semua Siswa';

		
		$data = DB::table('table_data_siswa as td')->distinct()->select('td.jurusan_id','tj.nama_jurusan','tj.singkatan_jurusan','td.tahun_ajaran')->join('tbl_jurusan as tj','tj.id','=','td.jurusan_id')->where('td.tahun_ajaran','2023/2024')->get();
		// dd(DataSiswa::where('tahun_ajaran','2021/2022')->get());
		dd($data);
	}
}
