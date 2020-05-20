<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

use App\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$users = User::oldest()->where(['role','!=','a'])->get();
		return view('admin.viewUsers',[
			'users' => $users,
		]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$rules = [
            'name' => ['required', 'string', 'max:255'],
			'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
			'address' => ['string','min:10'],
			'gender' => ['required'],
			'role' => ['required'],
			'phone' => ['string','digits:11','unique:users'],
			'cnic' => ['string','regex:/[0-9]{5}-[0-9]{7}-[0-9]{1}/','unique:users'],
			'age' => ['string','digits_between:1,3','required'],
			'password' => ['required', 'string', 'min:8', 'confirmed'],
		];

		$this->validate($request, $rules);

        $user = User::create([
            'name' => $request->input('name'),
			'email' => $request->input('email'),
			'address' => $request->input('address'),
			'gender' => $request->input('gender'),
			'phone' => $request->input('phone'),
			'cnic' => $request->input('cnic'),
			'age' => $request->input('age'),
			'role' => $request->input('role'),
			'password' => Hash::make($request->input('password')),
		]);

		
		$email = $request->post()['email'];
		$id = \Auth::user()->id;
		$user_id = $user->where('email',$email)->value('id');
		$role = $user->where('email',$email)->value('role');
		if($role !== 'a'){
			return redirect()->action(
				'AdminController@showRoleForm', 
				['id'=>$id,'user_id' => $user_id,'role'=>$role]
			);
		} else{
			return redirect()->action(
				'AdminController@index'
			);
		}
		
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
			'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(\Auth::id())],
			'address' => ['string','min:10'],
			'gender' => ['required'],
			'role' => ['required'],
			'phone' => ['string','digits:11',Rule::unique('users')->ignore(\Auth::id())],
			'cnic' => ['string','regex:/[0-9]{5}-[0-9]{7}-[0-9]{1}/',Rule::unique('users')->ignore(\Auth::id())],
			'age' => ['string','digits_between:1,3','required'],
		];
		if($request->input('role') == 'p'){
			$rules['emergencey_contact'] = ['string','digits:11',Rule::unique('patients')->ignore(\Auth::user()->patient->id)];
		}

		$this->validate($request, $rules);

		$user = User::find($id);
        $user->name = $request->input('name');
		$user->email = $request->input('email');
		$user->address = $request->input('address');
		$user->gender = $request->input('gender');
		$user->phone = $request->input('phone');
		$user->cnic = $request->input('cnic');
		$user->age = $request->input('age');
		$user->save();
		
		switch(\Auth::user()->role){
			case 'p':
				return redirect()->action('PatientController@index');
			break;
			case 'd':
				return redirect()->action('DoctorController@index');
			break;
			case 'hs':
				return redirect()->action('HelpingStaff@index');
			break;
			case'sgc':
				return redirect()->action('SupportGroupConductor@index');
			break;
			case 'a':
				return redirect()->action('AdminController@index');
			break;
		}
    }

	public function redirectFromRole($role){
		switch($role){
			case 'p':
				return 'PatientController@index';
			break;
			case 'd':
				return 'DoctorController@index';
			break;
			case 'hs':
				return 'HelpingStaff@index';
			break;
			case'sgc':
				return 'SupportGroupConductor@index';
			break;
			case 'a':
				return 'AdminController@index';
			break;
		}
	}
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
	}
	
	public function showProfile($id){
		if($id != \Auth::user()->id && \Auth::user()->role != 'a'){
			return redirect()->action($this->redirectFromRole(\Auth::user()->role));
		}

		$user = User::find($id);

		return view('pages.profile',[
			'user' => $user,
		]);
	}
}
