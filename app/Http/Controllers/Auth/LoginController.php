<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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

    // /**
    //  * Where to redirect users after login.
    //  *
    //  * @var string
    //  */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
	}
	
	protected function redirectTo(){
		if(\Auth::user()->role=='p'){
			return '/patient';
		}elseif(\Auth::user()->role=='d'){
			return '/doctor';
		} elseif(\Auth::user()->role=='hs'){
			return '/helpingStaff';
		}elseif(\Auth::user()->role=='sgc'){
			return '/supportGroupConductor';
		}elseif(\Auth::user()->role=='a'){
			return '/admin';
		} 
	}
}
