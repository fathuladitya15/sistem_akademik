<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Http\Controllers\CekSiswaController;


class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function index()
    {
		$pageTitle 		= "Dashboard";
		$SubPageTitle 	= "Dashboard";
		if (Auth::user()->role == 'siswa'&&(Auth::user()->status_akun == 0)) {
			return view("auth.datadiri");
			
		} 
		// dd(Auth::user());
        return view('home', compact('pageTitle','SubPageTitle'));
    }
}
