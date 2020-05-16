<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        //
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
			'phone' => ['string','digits:11'],
			'cnic' => ['string','regex:/[0-9]{5}-[0-9]{7}-[0-9]{1}/'],
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
				['user_id' => $user_id,'role'=>$role]
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
        //
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
}
