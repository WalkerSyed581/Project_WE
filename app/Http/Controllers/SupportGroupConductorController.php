<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SupportGroupConductor;
use App\SupportGroup;
use Carbon\Carbon;

class SupportGroupConductorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
			'salary' => ['string','integer','required'],
			'user_id' => ['required'],
        ];

		$this->validate($request, $rules);

        $supportGroupConductor = SupportGroupConductor::create([
			'salary' => $request->input('salary'),
			'joining_date' => Carbon::now(),
			'user_id' => $request->input('user_id'),
		]);

		
		return redirect()->action('AdminController@index');
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
    public function update(Request $request, $sgc_id)
    {
		$rules = [
			'salary' => ['string','integer','required'],
        ];

		$this->validate($request, $rules);

        $sgc = SupportGroupConductor::find($sgc_id);
		$sgc->salary = $request->input('salary');
		$sgc->save();
		
		return redirect()->action('UsersController@index',['id'=>\Auth::id()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id,$sgc_id)
    {
		SupportGroupConductor::find($sgc_id)->delete();
		User::find($user_id)->delete();

		return redirect()->action('UsersController@index',['id'=>\Auth::id()]);		
	}
}
