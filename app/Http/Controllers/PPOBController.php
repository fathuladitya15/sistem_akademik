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
					
				return '<a href="javascript:void(0)" onclick="verifikasi('.$data->id.')" id="verifikasi_pembayaran" class="btn btn-light btn-active-light-primary btn-sm" title="Verifikasi Pembayaran" >
                                <span class="svg-icon svg-icon-5 m-0">
								 <img src="assets/media/icons/new/invoice.svg"  width="24" height="24" alt="">	
                                </span>
                            </a>';
				}
		})
		->rawColumns(['action','status_pembayaran','created_at']);
		
		
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
}
