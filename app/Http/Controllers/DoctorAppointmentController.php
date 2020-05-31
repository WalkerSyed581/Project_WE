<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\DoctorAppointment;
use App\Bill;
use Carbon\Carbon;

class DoctorAppointmentController extends Controller
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
			'appointmentTime' => ['date_format:H:i'],
			'appointmentDate' => ['date_format:Y-m-d'],
			'notes' => ['string','nullable'],
        ];
		$this->validate($request, $rules);


		$fomratted_start_date = Carbon::parse($request->input('appointmentDate') . $request->input('appointmentTime'));
		$data = [
			'patient_id' => $request->input('patient_id'),
			'doctor_id' => $request->input('doctor_id'),
			'cancelled' => 0,
			'time' => $fomratted_start_date->toDateTimeString(),
			'notes' => $request->input('notes')
		];
		
		if($request->input('approved')){
			$data['approved'] = $request->input('approved');
		} else{
			$data['approved'] = 0;
		}
		$patient_id = $request->input('patient_id');
        $appointment = DoctorAppointment::create($data);
		
		$bill = Bill::create([
			'patient_id' => $patient_id,
			'doctor_appointment_id' => $appointment->id,
		]);
		
		if(\Auth::user()->role == 'd'){
			return redirect()->action('DoctorController@index');
		} else {
			return redirect()->action('PatientController@index');
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
    public function destroy($appointment_id)
    {
		$appointment = DoctorAppointment::where('id',$appointment_id)->first();
		$appointment->cancelled = true;
		$appointment->save();

		return redirect()->action('PatientController@index');
	}
	public function approveAppointment($id,$appointment_id){
		$appointment = DoctorAppointment::where('id',$id)->first();
		
		if($appointment->approved){
			$appointment->approved = false;
		}else{
			$appointment->approved = true;
		}
		$appointment->save();

		return redirect()->action('DoctorController@index');
	}
}
