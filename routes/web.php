<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\HomeController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\UserManagementController;


// Auth Controller
use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();
Route::middleware('revalidate')->group(function (){
	Route::get('/verifikasi',[VerificationController::class,'show'])->name('verification.notice');
	Route::post('/verifikasi/resend',[VerificationController::class,'resend'])->name('verification.resend');
	Route::get('/verifikasi/verify',[VerificationController::class,'verify'])->middleware(['auth', 'signed'])->name('verification.verify');
	Route::get('/home', [HomeController::class, 'index'])->name('home');

	Route::middleware('role:admin')->group(function ()	{
		Route::get('/pengaturan',[PengaturanController::class,'index'])->name('pengaturan');
		Route::post('/pengaturan/update/profile',[PengaturanController::class,'update_profile_sekolah'])->name('update.profile.sekolah');

		Route::get('/user-management/list',[UserManagementController::class,'User_list'])->name("user.list");
		Route::get('/user-management/list/data',[UserManagementController::class,'json_user_list'])->name("user.list.ajax");
	});
});


Route::get('/login',[LoginController::class,'showLoginForm'])->name('login');
Route::post('/login',[LoginController::class,'login'])->name('login.post');

Route::get('/register',[RegisterController::class,'index'])->name('register');
Route::post('/register',[RegisterController::class,'register'])->name('register.post');

Route::get('/password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
Route::post('/password/confirm', 'Auth\ConfirmPasswordController@confirm')->name('password.confirm');
Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');

Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('/password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');

Route::post('/logout', [LoginController::class,'logout'])->name('logout');