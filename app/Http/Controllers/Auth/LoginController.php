<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;

    protected function redirectTo()
    {
        $user = Auth::user();
        if ($user->is_verified) {
            return '/pagrindinis';
        }
        return '/autorizacija';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        $errors = []; 

        if (!$request->get('email')) {
            $errors['email'] = 'Būtina įvesti el. paštą.';
        }

        if (!$request->get('password')) {
            $errors['password'] = 'Būtina įvesti slaptažodį.';
        }

        if (empty($errors)) {
            $errors['email'] = 'Neregistruotas el. pašto adresas arba neteisingas slaptažodis.';
        }

        throw ValidationException::withMessages($errors);
    }
}
