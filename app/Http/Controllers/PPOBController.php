<?php

namespace App\Http\Controllers;

use DB;
use Str;
use Auth;
use DataTables;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Jurusan;
use App\Models\LogClass;
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

	function data_ppdb(Request $request) 
	{
		$data = User::where('role','siswa')->get();
		
		$table = Datatables::of($data)
		->addIndexColumn()
		->filter(function ($instance) use ($request) {
			if (!empty($request->get('name'))) {
				$instance->collection = $instance->collection->filter(function ($row) use ($request) {
					return Str::contains($row['name'], $request->get('name')) ? true : false;
				});
			}
	
			if (!empty($request->get('search'))) {
				$instance->collection = $instance->collection->filter(function ($row) use ($request) {
					if (Str::contains(Str::lower($row['name']), Str::lower($request->get('search')))){
						return true;
					}else if (Str::contains(Str::lower($row['name']), Str::lower($request->get('search')))) {
						return true;
					}
	
					return false;
				});
			}
	
		})
		->addColumn('created_at', function ($data){
			return Carbon::parse($data->created_at)->format('l, d M Y');
		})
		->addColumn('status_pembayaran', function ($data)  {
			$status = Pembayaran::where("user_id",$data->id)->first();
			if ($status) {
				if ($status->status_pembayaran == 0) {
					if ($status->bukti_pembayaran == null) {
						$r = '<div class="badge badge-light-warning fw-bolder">Belum Bayar</div>';
					}else {
						// $r = '<div class="badge badge-light-info fw-bolder">Sudah Transfer</div>';
						$r = '<button class="btn btn-light btn-active-light-info btn-sm "  onclick="bukti()" data-image="'.$status->bukti_pembayaran.'" > Lihat Bukti  </button>';
					}
				}else if ($status->status_pembayaran == 1) {
					$r = '<div class="badge badge-light-success fw-bolder">Sudah Bayar</div>';
				}
			}else {
				$r = '<div class="badge badge-light-danger fw-bolder">Kadaluarsa</div>';
			}
			return $r ;
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
			'kelas' => 10,
			'tahun_ajaran' => tahun_ajaran('baru'),
			'nilai_rata' => $request->nilai_rata,
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


	function index_data_siswa()  {
		$pageTitle 		= 'Data Siswa Tahun Ajaran '. tahun_ajaran('baru');
		$SubPageTitle 	= 'Data Siswa Tahun Ajaran '. tahun_ajaran('baru');

		$jurusan 		= Jurusan::count();
		$cek_log_class = LogClass::where('ThnAjaran',tahun_ajaran('baru'))->count();

		if ($jurusan == $cek_log_class) {
			$notif = TRUE;
		}else {
			$notif = FALSE;
		}

		return view('PPDB.siswa_baru', compact('pageTitle','SubPageTitle','notif'));
	}

	function ajax_data_siswa()  
	{
		$tahun_ajaran = tahun_ajaran('baru');
		$data = DataSiswa::where('tahun_ajaran',$tahun_ajaran)->orderby('jurusan_id')->get();
		// $data = DB::table('table_data_siswa as td')->select('td.*')->join('users as us','us.id','=','td.user_id')->where('us.role','siswa')->where('td.tahun_ajaran',$tahun_ajaran)->orderby('td.jurusan_id')->get();
		
		$table = Datatables::of($data)
		->addIndexColumn()
		->addColumn('name', function ($data) {
			$data = User::where('id',$data->user_id)->first();

			return $data->name;
		})
		->addColumn('jurusan_id', function ($data)  {
			$jurusan_p   = Jurusan::where('id',$data->jurusan_id)->first()->singkatan_jurusan;
			$jurusan     = Jurusan::where('id',$data->jurusan_opsi_id)->first()->singkatan_jurusan;

			return $jurusan_p.','.$jurusan;
		})
		->rawColumns(['name','jurusan_id']);
		
		
		return $table->make(true);
	}

	function ajax_data_siswa_rancangan() {
		// $data  = User::with('DataSiswa')->get();
		$data = DB::table('table_data_siswa as td')->distinct()->select('td.jurusan_id','tj.nama_jurusan','tj.singkatan_jurusan','td.tahun_ajaran')->join('tbl_jurusan as tj','tj.id','=','td.jurusan_id')->where('td.tahun_ajaran','2023/2024')->get();

		$table = Datatables::of($data)
		->addColumn('jurusan', function($data) {
			return $data->singkatan_jurusan;
		})
		->addColumn('ljmlsiswa', function ($data)  {
			$db = DataSiswa::where('jenis_kelamin','L')->where('jurusan_id',$data->jurusan_id)->where('tahun_ajaran','2023/2024')->count();
			return $db;
		})
		->addColumn('pjmlsiswa', function ($data)  {
			$db = DataSiswa::where('jenis_kelamin','P')->where('jurusan_id',$data->jurusan_id)->where('tahun_ajaran','2023/2024')->count();
			return $db;
		})
		->addColumn('tjmlsiswa', function ($data)  {
			$l = DataSiswa::where('jenis_kelamin','L')->where('jurusan_id',$data->jurusan_id)->where('tahun_ajaran','2023/2024')->count();
			$p = DataSiswa::where('jenis_kelamin','P')->where('jurusan_id',$data->jurusan_id)->where('tahun_ajaran','2023/2024')->count();

			$db = $p+$l;
			return $db;
		})
		->addColumn('total_rombel', function ($data)  {
			$l 		= DataSiswa::where('jenis_kelamin','L')->where('jurusan_id',$data->jurusan_id)->where('tahun_ajaran','2023/2024')->count();
			$p 		= DataSiswa::where('jenis_kelamin','P')->where('jurusan_id',$data->jurusan_id)->where('tahun_ajaran','2023/2024')->count();
			$db 	= $p+$l;
			$TotalSiswaPerKelas = 36;

			$rombel	 = mod($db,$TotalSiswaPerKelas,1);
			return $rombel;
		})
		->addColumn('lperkelas', function ($data) {
			$l 		= DataSiswa::where('jenis_kelamin','L')->where('jurusan_id',$data->jurusan_id)->where('tahun_ajaran','2023/2024')->count();
			$p 		= DataSiswa::where('jenis_kelamin','P')->where('jurusan_id',$data->jurusan_id)->where('tahun_ajaran','2023/2024')->count();
			$db 	= $p+$l;

			$TotalSiswaPerKelas = 36;

			$rombel	 = mod($db,$TotalSiswaPerKelas,1);
			$laki_r  = mod($l,$rombel,0);
			return $laki_r;
			
		})
		->addColumn('pperkelas', function ($data) {
			$l 		= DataSiswa::where('jenis_kelamin','L')->where('jurusan_id',$data->jurusan_id)->where('tahun_ajaran','2023/2024')->count();
			$p 		= DataSiswa::where('jenis_kelamin','P')->where('jurusan_id',$data->jurusan_id)->where('tahun_ajaran','2023/2024')->count();
			$db 	= $p+$l;
			$TotalSiswaPerKelas = 36;

			$rombel	 = mod($db,$TotalSiswaPerKelas,1);
			$laki_p  = mod($p,$rombel,0);
			return $laki_p;
			
		})
		->addColumn('total_perkelas', function ($data)  {
			$l 		= DataSiswa::where('jenis_kelamin','L')->where('jurusan_id',$data->jurusan_id)->where('tahun_ajaran','2023/2024')->count();
			$p 		= DataSiswa::where('jenis_kelamin','P')->where('jurusan_id',$data->jurusan_id)->where('tahun_ajaran','2023/2024')->count();
			$db 	= $p+$l;
			$TotalSiswaPerKelas = 36;

			$rombel	 = mod($db,$TotalSiswaPerKelas,1);
			$laki_r  = mod($l,$rombel,0);
			$pere_r  = mod($p,$rombel,0);

			return $pere_r + $laki_r;
		})
		->addColumn('aksi', function ($data) {
			$button = '<button class="btn btn-primary" > Generate Kelas </button>';
			return $button;			
		})
		->rawColumns(['name','ljmlsiswa','pjmlsiswa','tjmlsiswa','pperkelas','lperkelas','total_perkelas','aksi']);

		return $table->make(true);
	}

	function ajax_data_siswa_absensi($jurusan = null, $rombel = null)  {
		$data = DB::table('table_data_siswa as td')
		->select('td.*','tj.nama_jurusan','tj.singkatan_jurusan','us.*')
		->join('tbl_jurusan as tj','tj.id','=','td.jurusan_id')
		->join('users as us' ,'us.id','=','td.user_id')
		->get();
		$table = Datatables::of($data,$rombel,$jurusan)
		->addColumn('nama', function ($data) use ($rombel,$jurusan) {
			$l 		= DataSiswa::where('jenis_kelamin','L')->where('jurusan_id',$data->jurusan_id)->count();
			$p 		= DataSiswa::where('jenis_kelamin','P')->where('jurusan_id',$data->jurusan_id)->count();
			$db 	= $p+$l;
			$bagi 	= $db/36;
			if (fmod($bagi,1) !== 0) {
				$r = round($bagi);
			}else {
				$r = $bagi ;
			}
			return $data->name;
		})
		->addColumn('jurusan', function ($data) {
			$jurusan = Jurusan::where('id',$data->jurusan_id)->first();

			return $jurusan->singkatan_jurusan;
		})
		->addColumn('jenis_kelamin', function ($data){
			return $data->jenis_kelamin;
		})
		->rawColumns(['nama','jurusan','jenis_kelamin']);
		return $table->make(true);
	}

	function upload_bukti_pembayaran(Request $request)  
	{

		$customMessages = [
			'required' 	=> ":attribute tidak boleh kosong",
			'image' 	=> ":attribute Harus berupa gambar",
		];

		$request->validate([
			'bukti_pembayaran' =>  'required|image|mimes:jpeg,png,jpg|max:2048'
		],$customMessages);

		$cek = DB::table('pembayaran')->where('user_id',Auth::id())->first()->bukti_pembayaran;
		if ($cek == "" && $cek == null) {
			$imageName = time().'_'.Auth::id().'.'.$request->bukti_pembayaran->extension();
			$path = 'assets/media/pembayaran/'.$imageName;
			$update = DB::table('pembayaran')->where('user_id',Auth::id())->update(['bukti_pembayaran' => $path,'status_pembayaran' => 1]);
			if ($update) {
				$save = $request->bukti_pembayaran->move(public_path('assets/media/pembayaran/'),$imageName);
				$res = ['sukses' => TRUE , 'pesan' => "Bukti Pembayaran Anda Terkirim,"];
			}else {
				$res = ['sukses' => FALSE , 'pesan' => "Terjadi Kesalahan,"];
			}
		}else {
			$res = ['sukses' => TRUE , 'pesan' => "Kami sedang melakukan pengecekan mohon tunggu ,"];
		}
		return response()->json($res);	
	}

	// function tesforeach()  {
	// 	$data = DB::table('table_data_siswa as td')->distinct()->select('td.jurusan_id','tj.nama_jurusan','tj.singkatan_jurusan')->join('tbl_jurusan as tj','tj.id','=','td.jurusan_id')->get();

	// 	$newf = [];

	// 	foreach ($data as $key ) {
	// 		// TOTAL SISWA BERDASARKAN JURUSAN
	// 		$l 		= DataSiswa::where('jenis_kelamin','L')->where('jurusan_id',$key->jurusan_id)->count(); 
	// 		$p 		= DataSiswa::where('jenis_kelamin','P')->where('jurusan_id',$key->jurusan_id)->count();

	// 		// PENJUMLAHAN TOTAL SISWA BERDASARKAN JURUSAN
	// 		$db 	= $p+$l;

	// 		// PROSES UNTUK MENENTUKAN JUMLAH KELAS YANG AKAN DIBUAT
	// 		// DALAM 1 KELAS ADALAH 36 SISWA , RUMUS MOD DIBUAT SENDIRI , TERDAPAT DI HELPERS.PHP
	// 		$TotalSiswaPerKelas = 36;

	// 		$rombel	 = mod($db,$TotalSiswaPerKelas,1);
	// 		$laki_r  = mod($l,$rombel,0);
	// 		$pere_r  = mod($p,$rombel,0);

	// 		$newf[] = [
	// 			'nama_jurusan' 				=> $key->nama_jurusan,
	// 			'Jumlah Siswa Laki- Laki' 	=> $l,
	// 			'Jumlah Siswa Perempuan' 	=> $p,
	// 			'Total Semua Siswa' 		=> $db,
	// 			'rombel' 					=> $rombel,
	// 			'Jumlah Siswa Laki Laki/kls'=> $laki_r,
	// 			'Jumlah Siswa Perempuan/kls'=> $pere_r,
	// 			'Total Siswa Per Kelas '    => $laki_r + $pere_r,
	// 			'Sisa Siswa Laki Laki'		=> $l - ($rombel*$laki_r),
	// 			'Sisa Siswa Perempuan'		=> $p - ($rombel*$pere_r),
					
	// 		]; 

	// 		LogClass::create([
	// 			'jurusan_id' => $key->jurusan_id,
	// 			'JmlSiswaL' => $l,
	// 			'JmlSiswap' => $p,
	// 			'JmlKls' 	=> $rombel,
	// 			'JmlLKls'	=> $laki_r,
	// 			'JmPLKls'	=> $pere_r,
	// 			'JmlSiswaKls' => $laki_r + $pere_r,
	// 			'ThnAjaran' => tahun_ajaran('baru'),
	// 		]);
	// 	}
	// 	dd($newf);
	// }


	function set_kelas($jurusan,$JmlhKls)  {
		
		if ($jurusan == 1 ) {
			
		}
		
	}
}
