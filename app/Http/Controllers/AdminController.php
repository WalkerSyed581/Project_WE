<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.index');
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
        //
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
	
	//Register any user
	// public function showRegisterForm($id){
    //     return view('admin.register')->with('id',$id);
	// }

	public function showRegisterForm(){
		return view('admin.register');
	}
	

	//Add data specific to the role
	public function showRoleForm($user_id,$role){
		return view('admin.addRoleData',[
			'user_id'=>$user_id,
			'role'=>$role,
		]);
	}
	
	public function registerRoleData(Request $request){
		$role = $request->post()['role'];

		if($role=='p'){
			return redirect()->action('DoctorController@store');
		}elseif($role=='d'){
			return redirect()->action('DoctorController@store');
		} elseif($role=='hs'){
			// return redirect()->action('DoctorController@store');
		}elseif($role=='sgc'){

		}elseif($role=='a'){
			
		} 
	}
}
