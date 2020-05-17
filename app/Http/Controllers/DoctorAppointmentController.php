<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\DoctorAppointment;
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
			'doctor_id' => ['required','integer'],
			'cancelled' => ['boolean','required'],
        ];
		$this->validate($request, $rules);


		$fomratted_start_date = Carbon::parse($request->input('appointmentDate') . $request->input('appointmentTime'));
		
        $appointment = DoctorAppointment::create([
			'patient_id' => \Auth::user()->patient->id,
			'doctor_id' => (int) $request->input('doctor_id'),
			'time' => $fomratted_start_date->toDateTimeString(),
			'notes' => $request->input('notes'),
			'cancelled' => (int) $request->input('cancelled'),
			'approved' => 0,
		]);
		
		return redirect()->action('PatientController@index');
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
		$appointment = DoctorAppointment::where('id',$id)->first();
		$appointment->cancelled = true;
		$appointment->save();

		return redirect()->action('DoctorController@index');
    }
}
