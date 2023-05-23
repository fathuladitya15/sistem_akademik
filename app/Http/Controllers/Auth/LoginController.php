<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class LoginController extends Controller
{

    // use AuthenticatesUsers;
	use ThrottlesLogins;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

	public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }
            $user = User::where('username', $request->username)->first();
            if ($user) {
                $user->is_login_from_admin = FALSE;
                $user->login_admin_id = NULL;
                $user->save();
            }
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

	protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }

	protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }

	protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }

        // return $request->wantsJson() ? new JsonResponse([], 204) : redirect()->intended($this->redirectPath());
        return $request->wantsJson() ? new JsonResponse([], 204) : new JsonResponse(['sukses' => TRUE ,'pesan' => 'Berhasil Login']);
    }


	protected function authenticated(Request $request, $user)
    {
        //
    }

	public function username()
    {
        return 'username';
    }

	public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notify[] = ['success', 'Berhasil Logout'];
        return redirect()->route('login')->withNotify($notify);
    }

	protected function loggedOut(Request $request)
    {
        //
    }

	protected function guard()
    {
        return Auth::guard();
    }
}
