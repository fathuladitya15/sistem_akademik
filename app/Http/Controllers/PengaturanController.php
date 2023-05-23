<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Setting;

use Validator;
class PengaturanController extends Controller
{
    function __construct()
	{
		$this->middleware('auth');
	}
	function index( )
	{
		$pageTitle 		= "Pengaturan";
		$SubPageTitle 	= $pageTitle; 
		$data 			= Setting::all();
		return view('pengaturan',compact('pageTitle','SubPageTitle','data'));
	}

	public function update_profile_sekolah(Request $request)
	{
		$valid = Validator::make($request->all(),[
			'nama_aplikasi' => 'string|required',
			'nama_sekolah'  => 'string|required',
			'nomer_telepon_sekolah' => 'required',
		]);
		
		if ($valid->fails()) {
		   $error = $valid->errors()->first();
		   $response = ['sukses' => FALSE, 'pesan' => $error];
		return response()->json($response);

		}
		$response = ['sukses' => TRUE, 'pesan' => 'Data Berhasil diperbaharui !','link_reload' => route('pengaturan')];
		return response()->json($response);
	}
}
