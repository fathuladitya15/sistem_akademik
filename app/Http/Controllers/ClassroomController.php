<?php

namespace App\Http\Controllers;

use Auth;
use DataTables;
use App\Models\Kelas;
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

	function get() : Returntype {
		
	}
}
