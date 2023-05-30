<?php

namespace App\Http\Controllers\Auth;

use Str;
use App\Models\User;
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
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    // use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
            'first_name' 		=> 'required|string|max:255',
            'last_name' 		=> 'required|string|max:255',
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
        return User::create([
            'name' => $data->first_name.' '.$data->last_name,
            'username' => Str::lower($data->last_name),
            'email' => $data->email,
            'password' => Hash::make($data->password),
			'status_akun' => 0,
			'role' => 'siswa',
        ]);
    }

    public function index()
    {
        return view('auth.register');
    }

	public function register(Request $request)
    {
		return response()->json($this->validator($request));
		// $customMessages = [
        // 	'required' => ' :attribute wajib diisi.',
		// 	'unique' => ':attribute Telah digunakan',
		// 	'password.min' => 'Password minimal 8 karakter atau lebih',
		// 	'toc.accepted' => 'Centang Syarat dan ketentuan',
    	// ];
		// $valid  = $request->validate([
        //     'first-name' 		=> 'required|string|max:255',
        //     'last-name' 		=> 'required|string|max:255',
        //     'email' 			=> 'required|string|email|max:255|unique:users,email',
        //     'password'			=> 'required|string|same:password-confirm|min:8',
		// 	'password-confirm'  => 'required',
		// 	'toc'				=> 'accepted',
        // ],$customMessages);
		// 	$cek_pass = regex($request->password);
		// if ($cek_pass == FALSE ) {
		// 	$response =  ['sukses' => FALSE,'pesan' => 'Minimal 8 Karakter atau lebih dengan huruf, numbers & simbol.'];
		// }
		// if (!$valid) {
		// 	$response = ['sukses' => FALSE ,'pesan' => $valid->errors()];
		// }else {
        	
		// 	$response = ['sukses' => TRUE ,'pesan' =>'berhasil'];
		// }
		// return $request->wantsJson() ? new JsonResponse([], 201) : new JsonResponse($response, 201);
		

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
