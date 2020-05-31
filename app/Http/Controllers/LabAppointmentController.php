<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LabReport;
use App\LabAppointment;
use Carbon\Carbon;
use App\DoctorAppointment;
use App\Bill;
use App\Prescription;

class LabAppointmentController extends Controller
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
			'helping_staff_id' => ['required','integer'],
			'lab_test_id' => ['required','integer'],
        ];
		$this->validate($request, $rules);


		$fomratted_start_date = Carbon::parse($request->input('appointmentDate') . $request->input('appointmentTime'));
		
        $appointment = LabAppointment::create([
			'patient_id' =>(int) $request->input('patient_id'),
			'prescription_id' =>(int) $request->input('prescription_id'),
			'helping_staff_id' => (int) $request->input('helping_staff_id'),
			'lab_test_id' => (int) $request->input('lab_test_id'),
			'time' => $fomratted_start_date->toDateTimeString(),
			'notes' => $request->input('notes'),
			'cancelled' => 0,
			'approved' => 0,
		]);
		$prescription = Prescription::find((int) $request->input('prescription_id'));
		
		$bill = Bill::create([
			'patient_id' => (int) $request->input('patient_id'),
			'lab_appointment_id' => $appointment->id,
		]);
		
		return redirect()->action('DoctorController@viewPrescription',['id'=>(int) $request->input('doctor_id'),'appointment_id'=>$prescription->doctor_appointment_id]);
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
        $appointment = LabAppointment::where('id',$id)->first();
		$appointment->cancelled = true;
		$appointment->save();

		if(\Auth::user()->role == 'p'){
			return redirect()->action('PatientController@index');
		} elseif (\Auth::user()->role == 'd'){
			return redirect()->action('DoctorController@index');
		}
	}
	
	public function showLabReport($id,$labAppointment_id){
		$labAppointment = LabAppointment::where('id',$labAppointment_id)->first();
		$labReport = $labAppointment->labReport;
		return view('patient.labReport',
			['labReport'=>$labReport]
		);
	}
}
