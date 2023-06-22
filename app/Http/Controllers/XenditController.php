<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use Xendit\Xendit;
class XenditController extends Controller
{

	private $token = "xnd_development_VAUG0sCFwdcawmBuGeYswUOrowFVdwiaY8kzYRHtrbHLwEaosYkW93HstjLCM3";

	function Balance()  
	{
		Xendit::setApiKey($this->token);
		$getBalance = \Xendit\Balance::getBalance('CASH');
		return $getBalance;
	}

	function Create_QR() 
	{
		
	}

	function getVirtualAccount()  
	{
		Xendit::setApiKey($this->token);
		
		$getVirtualAccBanks = \Xendit\VirtualAccounts::getVABanks();

		dd($getVirtualAccBanks);
	}

	function cek_pembayaran(Request $request)  
	{

		Xendit::setApiKey($this->token);

		$params = [
			'external_id' => 'demo_123456',
			'type' => 'STATIC',
			'callback_url' => 'https://webhook.site',
			'amount' => 10000,
		];
		
		// $qr_code = \Xendit\QRCode::create($params);
		$get = \Xendit\QRCode::get('demo_123456');
		// var_dump($qr_code)

		return response()->json($get);
	}

	function generate_VA(Request $request)  
	{
		$va =  Auth::id().mt_rand(10000000000,99999999999);
		$params = [
			// 'user_id' => Auth::id(),
			'external_id' => $va,
			'bank_code' => $request->get('code'),
			// 'name' => Auth::user()->name,
		];
		return $params;	
	}
}
