<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
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

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

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
            'voornaam' => 'required|max:255',
            'achternaam' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'geslacht' => 'required|max:5',
            'burgerlijke_staat' => 'required|max:45',
            'studentnummer' => 'required',
            'post_adres' => 'required|max:255',
            'telefoonnummer' => 'required|max:15',
            'geboortedatum' => 'required',
            'geboorteplaats' => 'required|max:255',
            'nationaliteit' => 'required|max:255',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'voornaam' => $data['voornaam'],
            'achternaam' => $data['achternaam'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'geslacht' => $data['geslacht'],
            'burgerlijke_staat' => $data['burgerlijke_staat'],
            'studentnummer' => $data['studentnummer'],
            'post_adres' => $data['post_adres'],
            'telefoonnummer' => $data['telefoonnummer'],
            'geboortedatum' => $data['geboortedatum'],
            'geboorteplaats' => $data['geboorteplaats'],
            'nationaliteit' => $data['nationaliteit'],
        ]);
    }
}
