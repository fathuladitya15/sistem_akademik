<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CekSiswaController extends Controller
{
    function __construct()
	{
		$this->middleware("auth");
	}

	function cek($data)
	{
		dd($data);
	}
}
