<?php

namespace App\Http\Controllers;

use Xendit\Xendit;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Http\Controllers\CekSiswaController;


class HomeController extends Controller
{

	private $token = "xnd_development_VAUG0sCFwdcawmBuGeYswUOrowFVdwiaY8kzYRHtrbHLwEaosYkW93HstjLCM3";

    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function index()
    {
		$pageTitle 		= "Dashboard";
		$SubPageTitle 	= "Dashboard";
		if (Auth::user()->role == 'siswa'&&(Auth::user()->status_akun == 0)) 
		{
			Xendit::setApiKey($this->token);
		
			$va = \Xendit\VirtualAccounts::getVABanks();
			$status_pembayaran = Pembayaran::where('user_id',Auth::id())->first()->status_pembayaran;
			return view("auth.datadiri", compact('va','status_pembayaran'));
			
		}
        return view('home', compact('pageTitle','SubPageTitle'));
    }
}
