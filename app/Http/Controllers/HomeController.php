<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 


class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function index()
    {
		dd($this->middleware('auth'));
		$pageTitle 		= "Dashboard";
		$SubPageTitle 	= "Dashboard"; 
        return view('home', compact('pageTitle','SubPageTitle'));
    }
}
