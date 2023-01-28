<?php

namespace App\Http\Controllers\Auth;

use App\member;
use App\toko;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Validation\Rule;


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
    protected $redirectTo = '';

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
        $id = toko::whereStatus(1)->first();

        return Validator::make($data, [
            'nohp' => ['required', 'string', 'max:255',
                 Rule::unique('otw_member')->where(function ($query) use($data, $id) { return $query->where('nohp', $data['nohp'])->where('id_toko', $id->id_toko); }),
            ],
            'nama' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $id = toko::whereStatus(1)->first();
        
        return member::create([
            'nohp' => $data['nohp'],
            'nama' => $data['nama'],
            'password' => Hash::make($data['password']),
            'id_toko' => $id->id_toko
        ]);
    }

    public function showRegistrationForm()
    {
        $toko = toko::whereStatus(1)->first();

        $title = "Daftar member baru";
        return view('customauth.register',compact('title','toko'));
    }
}
