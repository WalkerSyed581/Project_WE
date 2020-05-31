<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Admission;
use App\Bill;

class AdmissionController extends Controller
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
			'appointmentTime' => ['date_format:H:i','required'],
			'appointmentDate' => ['date_format:Y-m-d','required'],
			'number_of_days' => ['integer','required'],
        ];
		$this->validate($request, $rules);


		$fomratted_start_date = Carbon::parse($request->input('appointmentDate') . $request->input('appointmentTime'));
		
        $admission = Admission::create([
			'patient_id' => (int) $request->input('patient_id'),
			'ward_id' => (int) $request->input('ward_id'),
			'helping_staff_id' => (int) $request->input('helping_staff_id'),
			'from_date' => $fomratted_start_date->toDateTimeString(),
			'discharged' => (int) $request->input('discharged'),
			'number_of_days' => (int) $request->input('number_of_days'),
		]);
		
		$bill = Bill::create([
			'patient_id' => (int) $request->input('patient_id'),
			'admission_id' => $admission->id,
		]);
		
		return redirect()->action('DoctorController@index');
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
			'appointmentTime' => ['date_format:H:i:s','required'],
			'appointmentDate' => ['date_format:Y-m-d','required'],
			'number_of_days' => ['integer','required'],
        ];
		$this->validate($request, $rules);


		$fomratted_start_date = Carbon::parse($request->input('appointmentDate') . $request->input('appointmentTime'));
		


		$admission = Admission::find($id);
		$admission->ward_id = (int) $request->input('ward_id');
		$admission->patient_id = (int) $request->input('patient_id');
		$admission->from_date = $fomratted_start_date->toDateTimeString();
		$admission->number_of_days = (int) $request->input('number_of_days');
		$admission->discharged =  (int) $request->input('discharged');
		$admission->save();
		
		return redirect()->action('HelpingStaffController@index');
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
