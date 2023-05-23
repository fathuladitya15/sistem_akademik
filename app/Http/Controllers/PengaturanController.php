<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
		return view('pengaturan',compact('pageTitle','SubPageTitle'));
	}
}
