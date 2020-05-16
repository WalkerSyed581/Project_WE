<?php

namespace App\Http\Controllers;
use App\User;
use App\Patient;
use Carbon\Carbon;

use Illuminate\Http\Request;

class PatientController extends Controller
{
    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function index()
    // {
    //     //
    // }

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
			'emergencey_contact' => ['string','digits:11'],
			'user_id' => ['required'],
        ];

		$this->validate($request, $rules);

        $patient = Patient::create([
			'emergencey_contact' => $request->input('emergencey_contact'),
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
	
	public function index(){
		// $patient = Patient::where('user_id',\Auth::user()->id)->first();
		// $docAppointments = $patient->doctorAppointments()->where([
		// 	['cancelled','=',false],
		// 	['time','>=',Carbon::now()->toTimeString()],
		// ])->get();
		// 
		// dd($docAppointments);
        return view('patient.index');
	}
	public function getAppointment($id){
        return view('patient.getAppointment');
	}
	public function showBill($id){
        return view('patient.bill');
	}
	public function joinSupportGroup($id){
        return view('patient.joinSupportGroup');
	}
	public function showLabReport(){
        return view('patient.labReport');
	}
}
