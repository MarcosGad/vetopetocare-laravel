<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
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

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
            return Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'birth' => ['required', 'string', 'max:255'],
                'gender' => ['required', 'string', 'max:255'],
                'country' => ['required', 'string', 'max:255'],
                'state' => ['required', 'string', 'max:255'],
                'city' => ['required', 'string', 'max:255'],
                'phone' => ['required', 'string', 'max:11'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ],[
                'required'  => 'هذا الحقل مطلوب',
                'email.required' => 'البريد الإلكتروني مطلوب',
                'email.email' => 'ادخل عنوان بريد إلكتروني صالح',
                'email.unique' => 'البريد الإلكتروني موجود بالفعل',
                'phone.max' => 'رقم المحمول لا يزيد عن 11 رقم',
                'password.required' => 'كلمة المرور مطلوبة',
                'password.confirmed' => 'كلمة المرور يجب ان تكون متطابقة',
                'password.min' => 'كلمة المرور يجب ان لا تقل عن 8 حروف'
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
        $createUser = User::create([
            'type' => 1,
            'name' => $data['name'],
            'birth' => $data['birth'],
            'gender' => $data['gender'],
            'country' => $data['country'],
            'state' => $data['state'],
            'city' => $data['city'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'active' => 1,
        ]);
        return $createUser;
    }
}
