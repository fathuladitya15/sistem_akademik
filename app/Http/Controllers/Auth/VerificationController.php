<?php

namespace App\Http\Controllers\Auth;

use Session;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Auth\Events\Verified;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Auth\Access\AuthorizationException;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    // use VerifiesEmails;

    /**
     * Where to redirect users after verification.
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
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

	 public function show(Request $request)
    {
		$pageTitle = 'Verifikasi';
		$SubPageTitle = 'verifikasi';
        return $request->user()->hasVerifiedEmail()
                        ? redirect($this->redirectPath())
                        : view('auth.verify',compact('pageTitle','SubPageTitle'));
    }
	public function verify(Request $request)
    {
        if (! hash_equals((string) $request->route('id'), (string) $request->user()->getKey())) {
			$verif = FALSE;
            // Session::set('status',FALSE);
        }

        if (! hash_equals((string) $request->route('hash'), sha1($request->user()->getEmailForVerification()))) {
            // Session::set('status',FALSE);
			$verif = FALSE;
			// throw new AuthorizationException;
        }

        if ($request->user()->hasVerifiedEmail()) {
			$verif = TRUE;
            return $request->wantsJson()
                        ? new JsonResponse([], 204)
                        : view('auth.verified',compact('verif'));
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        if ($response = $this->verified($request)) {
            return $response;
        }

        return $request->wantsJson()
                    ? new JsonResponse([], 204)
                    : redirect(route('home'))->with('verified', true);
    }

    protected function verified(Request $request)
    {
        //
    }
    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return $request->wantsJson()
                        ? new JsonResponse([], 204)
                        : redirect($this->redirectPath());
        }

        $request->user()->sendEmailVerificationNotification();

        return $request->wantsJson()
                    ? new JsonResponse([], 202)
                    : back()->with('resent', true);
    }
}
