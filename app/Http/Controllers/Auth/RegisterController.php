<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Patient;
use App\Doctor;
use App\HelpingStaff;
use App\SupportGroupConductor;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = RouteServiceProvider::PATIENT;

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
			'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
			'address' => ['string','min:10'],
			'gender' => ['required'],
			'role' => ['required'],
			'phone' => ['string','digits:11'],
			'emergencey_contact' => ['string','digits:11'],
			'cnic' => ['string','regex:/[0-9]{5}-[0-9]{7}-[0-9]{1}/'],
			'age' => ['string','digits_between:1,3','required'],
			'password' => ['required', 'string', 'min:8', 'confirmed'],
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
        return User::create([
            'name' => $data['name'],
			'email' => $data['email'],
			'address' => $data['address'],
			'gender' => $data['gender'],
			'phone' => $data['phone'],
			'cnic' => $data['cnic'],
			'age' => $data['age'],
			'role' => $data['role'],
			'password' => Hash::make($data['password']),
		]);
		
	}
	public function register(Request $request)
    {
        $this->validator($request->all())->validate();
		event(new Registered($user = $this->create($request->all())));

		$email = $request->post()['email'];

		$id = $user->where('email',$email)->value('id');
		$role = $user->where('email',$email)->value('role');
		switch($role){
			case 'p':
				Patient::create([
					'user_id' => $id,
					'emergencey_contact' => $request->post()['emergencey_contact'], 
				]);
				break;
		}

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
                    ? new Response('', 201)
                    : redirect($this->redirectPath());
    }
}
