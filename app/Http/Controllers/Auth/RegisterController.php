<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/autorizacija';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]+$/',
                'confirmed',
            ],
        ], [
            'first_name.required' => 'Būtina įvesti naudotojo vardą',
            'first_name.max' => 'Naudotojo vardas negali būti ilgesnis nei 255 simboliai',
            'last_name.required' => 'Būtina įvesti naudotojo vardą',
            'last_name.max' => 'Naudotojo vardas negali būti ilgesnis nei 255 simboliai',
            'email.required' => 'Būtina įvesti el. pašto adresą',
            'email.email' => 'Neteisingas el. pašto formatas',
            'email.max' => 'El. pašto adresas negali būti ilgesnis nei 255 simboliai',
            'email.unique' => 'Toks el. pašto adresas jau egzistuoja',
            'password.required' => 'Būtina įvesti naudotojo slaptažodį. Slaptažodį turi sudaryti bent 8 simboliai ir turi būti bent 1 didžioji raidė, 1 skaičius ir 1 specialusis simbolis',
            'password.min' => 'Slaptažodį turi sudaryti bent 8 simboliai',
            'password.regex' => 'Slaptažodis turi turėti bent vieną didžiąją raidę, vieną skaičių ir vieną specialųjį simbolį (@, $, !, %, *, #, ?, & ir kt.)',
            'password.confirmed' => 'Slaptažodžio patvirtinimas nesutampa'
        ]);
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
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
