<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    function __construct()  
	{
		$this->middleware('auth');
	}

	function index()  
	{
		$pageTitle = 'Pembayaran PPDB';
		$SubPageTitle = 'Pembayaran PPDB';
		return view('pembayaran.ppdb', compact('pageTitle','SubPageTitle'));	
	}

	function ajax_index(Request $request) {
		
	}
}
