<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

use Socialite;
use Exception;
use App\User;

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
    protected $redirectTo = RouteServiceProvider::HOME;
    protected function redirectTo()
    {
        if(!Auth::guest() && auth()->user()->active == 1){
            return '/';
        }else{
            return '/not-active';
        } 
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
    
    
    public function redirectToFacebook() {
        return Socialite::driver('facebook')->redirect();
    }
    public function handleFacebookCallback() {
        try {
            $user = Socialite::driver('facebook')->user();
            $finduser = User::where('facebook_id', $user->id)->first();
            if ($finduser) {
                Auth::login($finduser);
                return redirect('/#');
            } else {
                $newUser = User::create(['type' => 1,'name' => $user->name, 'email' => $user->email, 'facebook_id' => $user->id, 'active' => 1]);
                Auth::login($newUser);
                return redirect('/#');
            }
        }
        catch(Exception $e) {
            return redirect('auth/facebook');
        }
    }
    
    
    //Google
    
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    
    public function handleGoogleCallback()
    {
        try {
  
            $user = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->id)->first();
 
            if($finduser){
   
                Auth::login($finduser);
                return redirect('/');
   
            }else{
                $newUser = User::create(['type' => 1,'name' => $user->name, 'email' => $user->email, 'google_id' => $user->id, 'active' => 1]);
                Auth::login($newUser);
                return redirect('/');
            }
  
        } catch (Exception $e) {
            return redirect('auth/google');
        }
    }
}
