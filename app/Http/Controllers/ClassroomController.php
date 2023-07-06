<?php

namespace App\Http\Controllers;

use Auth;
use DataTables;
use App\Models\Kelas;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    function __construct()
	{
		$this->middleware("auth");
	}
	

	public function index() 
	{
		$pageTitle = "Management Kelas";
		$SubPageTitle = "Kelas";
		return view('class.index',compact('pageTitle','SubPageTitle'));
	}

	public function data_index()  
	{
		$data  = Kelas::all();

		$table = Datatables::of($data)
		->addIndexColumn()
		->addColumn('actions', function ($data)  {
			$hapus = '<a href="javascript:void(0)" onclick="hapus('.$data->id.')" data-kelas="'.$data->kelas.'/'.$data->sub_kelas.'" id="hapus" class="btn btn-light btn-active-light-danger btn-sm"> Hapus </a>';
			$edit  = '<a href="javascript:void(0)" onclick="edit(this)" data-kelas="'.$data->kelas.'" data-sub="'.$data->sub_kelas.'" data-id="'.$data->id.'" id="edit" class="btn btn-light btn-active-light-primary btn-sm"> Edit </a>';
			return $hapus.$edit;
		})
		->rawColumns(['actions']);
		return $table->make(true);
		
	}

	function save(Request $request)  
	{
		$this->validasi($request);

		if ($request->id == null && $request->id == "") {
			$save = Kelas::create(['kelas' => $request->kelas,'sub_kelas' => $request->subkelas]);
			$res = ['sukses' => TRUE, 'pesan' => 'Data Berhasil disimpan'];
		}else {
			$save = Kelas::where('id',$request->id)->update(['kelas' => $request->kelas,'sub_kelas' => $request->subkelas]);
			$res = ['sukses' => TRUE, 'pesan' => 'Data Berhasil diupdate'];
		}
		
		if ($save) {
			$response = $res ;
		}else {
			$response = ['sukses' => FALSE, 'pesan' => 'Terjadi Kesalahan'];
		}

		return response()->json($response);	
	}

	function validasi($request) 
	{
		$customMessages = [
			'required' => ':attribute wajib diisi',
		];

		$r = $request->validate([
			'kelas' => 'required',
			'subkelas' => 'required',
		],$customMessages);	

		return TRUE;
	}

	function hapus($id)  
	{	
		Kelas::find($id)->delete();

		return response()->json(['sukses'=> TRUE, 'pesan' => 'Kelas Berhasil dihapus!']);
	}

	public function jurusan_index() 
	{
		$pageTitle = "Management Jurusan";
		$SubPageTitle = "Jurusan";
		return view('class.jurusan_index',compact('pageTitle','SubPageTitle'));
	}

	public function jurusan_data_index()  
	{
		$data  = Jurusan::all();

		$table = Datatables::of($data)
		->addIndexColumn()
		->addColumn('actions', function ($data)  {
			$hapus = '<a href="javascript:void(0)" onclick="hapus('.$data->id.')" data-id="'.$data->id.'" data-jurusan="'.$data->nama_jurusan.'" id="hapus" class="btn btn-light btn-active-light-danger btn-sm"> Hapus </a>';
			$edit  = '<a href="javascript:void(0)" onclick="edit(this)" data-id="'.$data->id.'" id="edit" class="btn btn-light btn-active-light-primary btn-sm"> Edit </a>';
			return $hapus.$edit;
		})
		->rawColumns(['actions']);
		return $table->make(true);
		
	}

	function jurusan_save(Request $request)  
	{
		$this->jurusan_validasi($request);

		if ($request->id == null && $request->id == "") {
			$save = Jurusan::create(['nama_jurusan' => $request->nama_jurusan,'singkatan_jurusan' => $request->singkatan_jurusan,'deskripsi_jurusan' => $request->deskripsi_jurusan]);
			$res = ['sukses' => TRUE, 'pesan' => 'Data Berhasil disimpan'];
		}else {
			$save = Jurusan::where('id',$request->id)->update(['nama_jurusan' => $request->nama_jurusan,'singkatan_jurusan' => $request->singkatan_jurusan,'deskripsi_jurusan' => $request->deskripsi_jurusan]);
			$res = ['sukses' => TRUE, 'pesan' => 'Data Berhasil diupdate'];
		}
		
		if ($save) {
			$response = $res ;
		}else {
			$response = ['sukses' => FALSE, 'pesan' => 'Terjadi Kesalahan'];
		}

		return response()->json($response);	
	}

	function jurusan_validasi($request) 
	{
		$customMessages = [
			'required' => ':attribute wajib diisi',
			'string' => ':attribute harus alphabet',
		];

		$r = $request->validate([
			'nama_jurusan' => 'required|string',
			'singkatan_jurusan' => 'required|string',
			'deskripsi_jurusan' => 'required|string',
		],$customMessages);	

		return TRUE;
	}

	function jurusan_hapus($id)  
	{	
		Jurusan::find($id)->delete();

		return response()->json(['sukses'=> TRUE, 'pesan' => 'Kelas Berhasil dihapus!']);
	}

	function jurusan_get_data($id) 
	{

		$data = Jurusan::where('id',$id)->first();

		return response()->json($data);
		
	}

}
