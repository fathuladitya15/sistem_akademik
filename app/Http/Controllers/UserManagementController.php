<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}

