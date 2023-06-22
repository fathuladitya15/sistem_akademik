<?php

namespace App\Http\Controllers\Auth;

use Str;
use App\Models\User;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered; 
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;


class RegisterController extends Controller
{
    // use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }


    protected function validator($request)
    {

		$customMessages = [
        	'required' => ' :attribute wajib diisi.',
			'unique' => ':attribute Telah digunakan',
			'password.min' => 'Password minimal 8 karakter atau lebih',
			'toc.accepted' => 'Centang Syarat dan ketentuan',
    	];
		$valid  = $request->validate([
            'pertama' 		=> 'required|string|max:255',
            'terakhir' 		=> 'required|string|max:255',
            'username' 		=> 'required|string|max:255|unique:users,username|regex:/^\S*$/u',
            'email' 			=> 'required|string|email|max:255|unique:users,email',
            'password'			=> 'required|string|same:password-confirm|min:8',
			'password-confirm'  => 'required',
			'toc'				=> 'accepted',
        ],$customMessages);
		if (!$valid) {
			$response = ['sukses' => FALSE ,'pesan' => $valid->errors()];
		}else {
			$this->create($request);
			$response = ['sukses' => TRUE ,'pesan' => 'Validated','data' => $request->all()];
		}
		return $response;
    }

    protected function create($data)
    {
		// $username = 'SW'.$data->
        $user =  User::create([
					'name' => $data->pertama.' '.$data->terakhir,
					'username' => $data->username,
					'email' => $data->email,
					'password' => Hash::make($data->password),
					'status_akun' => 0,
					'role' => 'siswa',
        		]);
		$invoice = Pembayaran::create([
			'user_id' => $user['id'],
			'kode_pembayaran' => $user['id'].mt_rand(1000000000,9999999999),
			'nominal_pembayaran' => 100000,
			'status_pembayaran' => 0,
			'detail_pembayaran' => 'Biaya Formulir Pendaftaran',
		]);
		return TRUE;
    }

    public function index()
    {
        return view('auth.register');
    }

	public function register(Request $request)
    {
		return $this->validator($request);
		// $customMessages = [
        // 	'required' 		=> ':attribute wajib diisi.',
		// 	'unique' 		=> ':attribute Telah digunakan',
		// 	'password.min'	=> 'Password minimal 8 karakter atau lebih',
		// 	'toc.accepted' 	=> 'Centang Syarat dan ketentuan',
    	// ];
		// $valid  = $request->validate([
        //     'pertama' 			=> 'required|string|max:255',
        //     'terakhir' 			=> 'required|string|max:255',
        //     'email' 			=> 'required|string|email|max:255|unique:users,email',
        //     'password'			=> 'required|string|same:password-confirm|min:8',
		// 	'password-confirm'  => 'required',
		// 	'toc'				=> 'accepted',
        // ],$customMessages);
		// $cek_pass = regex($request->password);
		// if ($cek_pass == FALSE ) {
		// 	$response =  ['sukses' => FALSE,'pesan' => 'Minimal 8 Karakter atau lebih dengan huruf, numbers & simbol.'];
		// 	if (!$valid) {
		// 		$response = ['sukses' => FALSE ,'pesan' => $valid->errors()];
		// 	}else {
				
		// 		$response = ['sukses' => TRUE ,'pesan' =>'berhasil'];
		// 	}
		// }
		// // return $request->wantsJson() ? new JsonResponse([], 201) : new JsonResponse($response, 200);
		// return response()->json($request->all())
		

    }

	protected function guard()
    {
        return Auth::guard();
    }

	protected function registered(Request $request, $user)
    {
        //
    }
}
