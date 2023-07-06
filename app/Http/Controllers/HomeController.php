<?php

namespace App\Http\Controllers;


use DB;
use Carbon\Carbon;
use Xendit\Xendit;
use App\Models\DataSiswa;
use App\Models\Pembayaran;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Http\Controllers\CekSiswaController;


class HomeController extends Controller
{

	private $token = "xnd_development_VAUG0sCFwdcawmBuGeYswUOrowFVdwiaY8kzYRHtrbHLwEaosYkW93HstjLCM3";

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
		$pageTitle 		= "Dashboard";
		$SubPageTitle 	= "Dashboard";
		if (Auth::user()->role == 'siswa' && (Auth::user()->status_akun == 0)) {
			Xendit::setApiKey($this->token);
			$kota 				= \Indonesia::allCities();
			$desa				= \Indonesia::allVillages();
			$prov				= \Indonesia::allProvinces();
			$daerah				= \Indonesia::allDistricts();
			$status_pembayaran	= Pembayaran::where('user_id',Auth::id())->first()->status_pembayaran;
			$datadiri			= DataSiswa::where('user_id',Auth::id())->count();
			$pageTitle 			= 'Data Diri';
			$SubPageTitle 		= 'Isi Lengakap Data Diri Anda';
			$cek_berkas_s			= DataSiswa::where('user_id',Auth::id())->first();
			$cek_berkas = $cek_berkas_s != null ? $cek_berkas_s->status_kelengkapan : "";
			$jurusan = Jurusan::all();
			return view("PPDB.datadiri", compact('datadiri','status_pembayaran','kota','pageTitle','SubPageTitle','desa','prov','daerah','cek_berkas','jurusan'));
			
		}

        return view('home', compact('pageTitle','SubPageTitle'));

    }

	function get_kota(Request $request) 
	{
		$term = trim($request->q);
		if (empty($term)) {
            return response()->json([]);
        }

        $tags = \Indonesia::search('jakarta')->allCities();

        $formatted_tags = [];

        foreach ($tags as $tag) {
            $formatted_tags[] = ['id' => $tag->id, 'text' => $tag->name];
        }

        return \Response::json($formatted_tags);
	}
}
