<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\PPOBController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\XenditController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\PembayaranController;
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

	Route::post('/home/cek_pembayaran',[XenditController::class,'cek_pembayaran'])->name('Xendit.AuthPayment');
	Route::get('/home/generate',[XenditController::class,'generate_VA'])->name('Xendit.generateVA');

	Route::middleware('role:admin')->group(function ()	{
		Route::get('/pengaturan',[PengaturanController::class,'index'])->name('pengaturan');
		Route::post('/pengaturan/update/profile',[PengaturanController::class,'update_profile_sekolah'])->name('update.profile.sekolah');

		Route::get('/user-management/list',[UserManagementController::class,'User_list'])->name("user.list");
		Route::get('/user-management/list/data',[UserManagementController::class,'json_user_list'])->name("user.list.ajax");

		Route::get('/PPDB',[PPOBController::class,'index'])->name('PPOB.index');
		Route::get('/PPDB/data',[PPOBController::class,'data_ppdb'])->name('PPDB.Ajax');
		Route::get('/PPDB/verifikasi_pembayaran/{id}',[PPOBController::class,'verifikasi_pembayaran'])->name('PPDB.verifikasi_pembayaran');
		Route::get('/PPDB/verifikasi_pemberkasan/{id}',[PPOBController::class,'verifikasi_pemberkasan'])->name('PPDB.verifikasi_pemberkasan');
		Route::get('/PPDB/get_kota',[PPOBController::class,'get_kota'])->name('PPDB.get_kota');
		Route::get('/PPDB/payments-status',[PembayaranController::class,'index'])->name('PPDB.status_pembayaran');

		Route::get('/DataSiswaBaru',[PPOBController::class,'index_data_siswa'])->name('PPDB.siswabaru');
		Route::get('/DataSiswaBaru/data',[PPOBController::class,'ajax_data_siswa'])->name('PPDB.siswabaru.ajax');
		Route::get('/DataSiswaBaru/data1',[PPOBController::class,'ajax_data_siswa_rancangan'])->name('PPDB.siswabaru.ajax.rancangan');
		Route::get('/DataSiswaBaru/data2/{jurusan}/{rombel}',[PPOBController::class,'ajax_data_siswa_absensi'])->name('PPDB.siswabaru.ajax.absensi');

		// Route::get('/DataSiswaBaru/testing',[PPOBController::class,'tesforeach']);


		Route::get('/ClassManagement',[ClassroomController::class,'index'])->name('class.index');
		Route::get('/ClassManagement/data',[ClassroomController::class,'data_index'])->name('class.data');
		Route::post('/ClassManagement/save',[ClassroomController::class,'save'])->name('class.save');
		Route::get('/ClassManagement/get/{id}',[ClassroomController::class,'get_data'])->name('class.get');
		Route::delete('/ClassManagement/hapus/{id}',[ClassroomController::class,'hapus'])->name('class.delete');

		Route::get('/jurusan',[ClassroomController::class,'jurusan_index'])->name('jurusan.index');
		Route::get('/jurusan/data',[ClassroomController::class,'jurusan_data_index'])->name('jurusan.data');
		Route::post('/jurusan/save',[ClassroomController::class,'jurusan_save'])->name('jurusan.save');
		Route::get('/jurusan/get/{id}',[ClassroomController::class,'jurusan_get_data'])->name('jurusan.get');
		Route::delete('/jurusan/hapus/{id}',[ClassroomController::class,'jurusan_hapus'])->name('jurusan.delete');


		Route::get('/kelas-management/{jurusan}/{kelas}',[ClassroomController::class,'kelas_per_jurusan'])->name('kelas.data');

		Route::get('/Siswa/index',[SiswaController::class,'index'])->name('siswa.index');

	});
	Route::post('PPDB/post_data',[PPOBController::class,'proses_kirim_data'])->name('PPDB.kirim_data');
	Route::get('/get_kota/{id}',[PPOBController::class,'cities'])->name('get_kota_by_code_provinsi');
	Route::get('/get_daerah/{id}',[PPOBController::class,'districts'])->name('get_daerah_by_code_kota');
	Route::get('/get_desa/{id}',[PPOBController::class,'villages'])->name('get_desa_by_code_daerah');
	Route::get('/cek_status_berkas/{id}',[PPOBController::class,'cek_berkas'])->name("PPDB.cek_berkas");

	Route::post('/upload-bukti-pembayaran',[PPOBController::class,'upload_bukti_pembayaran'])->name('PPDB.Upload_bukti');
});

Route::get('/get_balance',[XenditController::class,'Balance'])->name('Xendit.Balance');
Route::get('/get_va',[XenditController::class,'getVirtualAccount'])->name('Xendit.Va');


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