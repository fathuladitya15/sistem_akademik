<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use DataTables;
use Carbon\Carbon;
use App\Models\User;
use App\Models\DataSiswa;
use App\Models\Pembayaran;

use Illuminate\Http\Request;

class PPOBController extends Controller
{
    function __construct()
	{
		$this->middleware("auth");
	}

	function index() 
	{
		$pageTitle = 'PPDB';
		$SubPageTitle = 'Penerimaan Peserta Didik Baru';
		return view('PPDB.index', compact('pageTitle','SubPageTitle'));
	}

	function data_ppdb() 
	{
		$data = User::where('role','siswa')->get();
		
		$table = Datatables::of($data)
		->addIndexColumn()
		->addColumn('created_at', function ($data){
			return Carbon::parse($data->created_at)->format('l, d M Y');
		})
		->addColumn('status_pembayaran', function ($data)  {
			$status = Pembayaran::where("user_id",$data->id)->first();
			if ($status) {
				if ($status->status_pembayaran == 0) {
					$r = '<div class="badge badge-light-warning fw-bolder">Belum Bayar</div>';
				}else if ($status->status_pembayaran == 1) {
					$r = '<div class="badge badge-light-success fw-bolder">Sudah Bayar</div>';
				}
			}else {
				$r = '<div class="badge badge-light-danger fw-bolder">Kadaluarsa</div>';
			}
			return $r;
		})
		->addColumn('status_berkas', function ($data)  {
			$siswa = DataSiswa::where('user_id',$data->id)->first();
			$data  = $siswa != null ? $siswa->status_kelengkapan : "";
			if ($data == "") {
				$s = '<div class="badge badge-light-warning fw-bolder">Belum Menyerahkan</div>';
			}else if($data == 0 ) {
				$s = '<div class="badge badge-light-info fw-bolder">Cek Berkas </div>';
			}else if($data == 1) {
				$s = '<div class="badge badge-light-warning fw-bolder">Berkas ada, Belum Komplit</div>';
			}
			else if($data == 2) {
				$s = '<div class="badge badge-light-success fw-bolder">Berkas Komplit</div>';
			}
			return $s;
		})
		->addColumn('status_siswa', function ($data){
			$find = DataSiswa::where('user_id',$data->id)->first();

			if ($find) {
				$r ='Sudah Terdaftar';
			}else {
				$r = 'Belum Terdaftar';
			}
			return $r;
		})
		->addColumn('action', function ($data) {
				if (Auth::id() == $data->id) {
					return '';
				}else {
					$status = Pembayaran::where("user_id",$data->id)->first();
					if ($status->status_pembayaran != 1) {
						$pay = '<a href="javascript:void(0)" onclick="verifikasi('.$data->id.')" id="verifikasi_pembayaran" class="btn btn-light btn-active-light-primary btn-sm" title="Verifikasi Pembayaran" >Verifikasi Pembayaran</a>';
					}else {
						$pay = '<a href="javascript:void(0)" onclick="berkas('.$data->id.')" id="verifikasi_berkas" class="btn btn-light btn-active-light-primary btn-sm" title="Verifikasi Pemberkasan" >Periksa Berkas</a>';
					}
				return $pay;
				}
		})
		->rawColumns(['action','status_pembayaran','created_at','status_berkas']);
		
		
		return $table->make(true);
	}

	function verifikasi_pembayaran($id)  
	{
		$find  = Pembayaran::where('user_id',$id)->first();

		if ($find) {
			$find->status_pembayaran = 1;
			$find->update();

			$res = ['sukses' => TRUE,'pesan' => 'Status Pembayaran siswa telah berubah'];
		}else {
			$res = ['sukses' => FALSE,'pesan'=>'Pembayaran Tidak ditemukan, Atau Terjadi Kesalahan '];
		}
		
		return response()->json($res);
 	}

	function proses_kirim_data(Request $request) {

		$customMessages = [
        	'required' 	=> ' :attribute wajib diisi.',
			'unique' 	=> ':attribute Telah digunakan',
			'numeric' 	=> ':attribute Harus berupa Angka',
			'digits' 	=> ':attribute Harus 10 Angka',
    	];
		$valid  = $request->validate([
			'nisn' 				=> 'required|numeric|digits:10|unique:table_data_siswa,nis',
            'jenis_kelamin'	 	=> 'required|string|max:255',
            'tanggal_lahir' 	=> 'required|string',
            'tempat_lahir' 		=> 'required|string',
			'nomerhp' 			=> 'required|numeric|min:10',
			'provinsi'			=> 'required',
			'kota_add'			=> 'required',
			'daerah'			=> 'required',
			'desa'				=> 'required',
			'alamat'			=> 'required',
			'jurusan'			=> 'required|string',
			'jurusan2'			=> 'required|string',
        ],$customMessages);


		$data = [
			'user_id' => Auth::id(),
			'nis' => $request->nisn,
			'jenis_kelamin' => $request->jenis_kelamin,
			'tempat_lahir' => $request->tempat_lahir,
			'tanggal_lahir' => $request->tanggal_lahir,
			'alamat' => $request->alamat,
			'nomer_telepon' => $request->nomerhp,
			'provinsi_code' => $request->provinsi,
			'kota_code' => $request->kota_add,
			'district_code' => $request->daerah,
			'villages_code' => $request->desa,
			'jurusan_id' => $request->jurusan,
			'jurusan_opsi_id' => $request->jurusan2,
 		];
		if ($request->jurusan != $request->jurusan2) {
			$create = DataSiswa::create($data);
			if ($create) {
				$response = ['sukses' => TRUE, 'pesan' => 'Data Anda Telah disimpan', 'sub' => 'Melanjutkan ke tahap selanjutnya...'];
			}else {
				$response = ['sukses' => FALSE ,'pesan' => 'Terjadi Kesalahan','sub' => 'Cek di proses kirim data'];
			}
		}else {
			$response = ['sukses' => FALSE, 'pesan' => 'Jurusan Kedua tidak boleh sama dengan Jurusan Pertama' ,'sub' => 'Pilih Jurusan sesuai dengan keingin anda'];
		}
		return response()->json($response);

	}

	function cities(Request $request , $id)
	{
		$search = DB::table('indonesia_cities')->where('province_code',$id)->where('name','LIKE','%'.$request->q.'%')->orderby('name','ASC')->get();
		return response()->json($search);
	}
	function districts(Request $request ,$id)
	{
		$search = DB::table('indonesia_districts')->where('city_code',$id)->where('name','LIKE','%'.$request->q.'%')->orderby('name','ASC')->get();
		return response()->json($search);
	}
	function villages(Request $request ,$id)  {
		$search = DB::table('indonesia_villages')->where('district_code',$id)->where('name','LIKE','%'.$request->q.'%')->orderby('name','ASC')->get();
		return response()->json($search);
	}

	function cek_berkas($id) 
	{
		$data  = DataSiswa::where('user_id',$id)->first()->status_kelengkapan;
		if ($data == "" && $data == null) {
			$update = DataSiswa::where('user_id',$id)->update(['status_kelengkapan' => 0]);
			return response()->json(['sukses' => TRUE,'pesan' => 'Kami Akan Meninjau Data Anda Terlebih Dahulu, ','sub' => "Tunggun Konfirmasi Kami Melalui Email Atau Whatsapp"]);
		}else {

			return response()->json(['sukses' => FALSE,'pesan' => 'Kami Sedang Mengecek Berkas Anda, ','sub' => "Tunggun Konfirmasi Kami Melalui Email Atau Whatsapp"]);

		}
	}

	function verifikasi_pemberkasan($id)  
	{
		$get_data  = DataSiswa::where('user_id',$id)->first();
		if ($get_data) {
			$data = User::where('id',$id)->first();
			$data->status_akun = 1;
			$data->update();
			
			$get_data->status_kelengkapan = 1;
			$get_data->update();

			$res = ['sukses' => TRUE,'pesan' => 'Pemberkasan Telah di Update'];
		}else {
			$res = ['sukses' => FALSE,'pesan' => 'Terjadi Kesalahan, Cek controller'];
		}
 		return response()->json($res);
	}
}
