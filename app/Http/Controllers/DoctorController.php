<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Doctor;
use App\User;
use Carbon\Carbon;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		return view('doctor.index');
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
			'specialization' => ['string'],
			'fee' => ['string','integer','required'],
			'start_time' => ['required','date_format:H:i'],
			'end_time' => ['required','date_format:H:i','after:start_time'],
		];
		
		$this->validate($request, $rules);

		$start_time = explode(':',$request->input('start_time'));
		$fomratted_start_time = Carbon::now();
		$fomratted_start_time->hour = (int) $start_time[0];
		$fomratted_start_time->minute = (int) $start_time[1];
		$fomratted_start_time->second = 0;


		$end_time = explode(':',$request->input('end_time'));
		$fomratted_end_time = Carbon::now();
		$fomratted_end_time->hour = (int) $end_time[0];
		$fomratted_end_time->minute = (int) $end_time[1];
		$fomratted_end_time->second = 0;
		


        $patient = Doctor::create([
			'salary' => $request->input('salary'),
			'specialization' => $request->input('specialization'),
			'fee' => $request->input('fee'),
			'starting_time' => $fomratted_start_time->format('H:i:s'),
			'end_time' => $fomratted_end_time->format('H:i:s'),
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
	

	
	public function patientInfo(){
		return view('doctor.patientInfo');
	}
	public function labReports(){
		return view('doctor.labReports');
	}
}
