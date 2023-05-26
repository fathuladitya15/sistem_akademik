<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
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


    protected function validator(array $data)
    {
		$valid = Validator::make($data, [
            'first-name' => 'required|string|max:255',
            'last-name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|required_with:password-confirm|same:password-confirmation',
			'password-confirm' => 'required|string|min:8',
        ]);
		if ($valid->fails()) {
			$response = ['sukses' => FALSE ,'pesan' => $valid->errors()];
		}
		$response = ['sukses' => TRUE ,'pesan' =>'berhasil'];
			
		return $response; 
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['fisrt_name'].' '.$data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
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
		// $validator = $this->validator($request->all());
		$customMessages = [
        	'required' => ' :attribute wajib diisi.',
			'unique' => ':attribute Telah digunakan',
			// 'regex' => 'Password harus menggunakan kombinasi huruf, angka & simbol.',
			'password.min' => 'Password minimal 8 karakter atau lebih',
			'toc.accepted' => 'Centang Syarat dan ketentuan',
    	];
		$valid  = $request->validate([
            'first-name' 		=> 'required|string|max:255',
            'last-name' 		=> 'required|string|max:255',
            'email' 			=> 'required|string|email|max:255|unique:users,email',
            'password'			=> 'required|string|same:password-confirm|min:8',
			'password-confirm'  => 'required',
			'toc'				=> 'accepted',
        ],$customMessages);
		if (!$valid) {
			$response = ['sukses' => FALSE ,'pesan' => $valid->errors()];
		}else {
			$response = ['sukses' => TRUE ,'pesan' =>'berhasil'];
		}
		return response()->json($response);
		// return $request->wantsJson() ? new JsonResponse([], 201) : new JsonResponse($response, 201);
		

        // event(new Registered($user = $this->create($request->all())));

        // $this->guard()->login($user);

        // if ($response = $this->registered($request, $user)) {
        //     return $response;
        // }

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
