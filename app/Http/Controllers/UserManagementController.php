<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Cabon\Carbon;
use DataTables;
use Str;
class UserManagementController extends Controller
{

	// Note

	// $pageTitle untuk menampilkan jdul paling atas
	// $header title adalah sub PageTitle nya

	function __construct()
	{
		$this->middleware("auth");
	}

	function User_list()
	{
		$pageTitle 		= "Daftar User "; 
		$SubPageTitle  	= ["User Management","Users","Users List"];
		
		return view('user_management.user_list',compact('pageTitle','SubPageTitle'));
	}

	function json_user_list(Request $request)
	{
		$table = User::all();

		$table = Datatables::of($table)
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
		->addColumn('name', function ($table) {
			if ($table->image_user_id != null ) {
				$src = '<div class="symbol-label">
                            	<img src="'.asset('assets/media/avatars/150-1.jpg').'" alt="'.Str::title($table->name).'" class="w-100" />
                            </div>';
			}else {
				$src = '<div class="symbol-label fs-3 bg-light-danger text-danger">'.inisial($table->name).'</div>';
			}
			$html = '<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                     	<a href="#">
                        	'.$src.'
                        </a>
                    </div>
                    <div class="d-flex flex-column">
                    	<a href="#" class="text-gray-800 text-hover-primary mb-1">'.Str::title($table->name).'</a>
                        <span>'.Str::limit($table->email,20).'</span>
                    </div>';
			return $html;
		})
		->addColumn('action', function ($table) {
			// $param = ;
				return '	<a href="javascript:void(0)" class="btn btn-light btn-active-light-primary btn-sm cus-trigger"  aria-expanded="false">Actions
                                <span class="svg-icon svg-icon-5 m-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <path
                                            d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                            fill="black" />
                                    </svg>
                                </span>
                            </a>
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3">Edit</a>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="javascript:void(0)" class="menu-link px-3"  onclick="return delete_row(this)" data-name="'.$table->name.'" data-id="'.$table->id.'">Delete</a>
                                </div>
                            </div>';
		})
		->rawColumns(['name','action']);

	return $table->make(true);
}
}

