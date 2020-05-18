<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Doctor;
use App\User;
use App\LabTest;
use App\HelpingStaff;
use App\Prescription;
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
		$doctor = Doctor::where('user_id',\Auth::user()->id)->first();
		$currentTime = Carbon::now()->toDateTimeString();

		$docAppointments = $doctor->doctorAppointments->where([
			['cancelled','=',false],
			['time','>=',$currentTime],
		])->get();

		$labAppointments = $doctor->doctorAppointments->prescription->labAppointment->where([
			['cancelled','=',false],
			['approved','=',true],
			['time','>=',$currentTime],
		])->get();

		$prevDocAppointments = $doctor->doctorAppointments->where([
			['cancelled','=',false],
			['approved','=',true],
			['time','<=',$currentTime],
		])->get();

		
        return view('doctor.index',[
			'docAppointments' => $docAppointments,
			'labAppointments' => $labAppointments,
			'prevDocAppointments' => $prevDocAppointments,
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
	


	public function viewPrescription($id,$appointment_id){
		$prescription = Prescription::where('doctor_appointment_id',$appointment_id)->first();
		$drugs = $prescription->drugs;
		$doctorAppointment = DoctorAppointment::find($appointment_id);
		$patient = $doctorAppointment->patient;
		return view('doctor.prescription',[
			'prescription' => $prescription,
			'drugs' => $drugs,
			'patient' => $patient,
			'appointment_id' => $appointment_id,
		]);
	}

	public function addPrescription(Request $request){
		$rules = [
			'condition' => ['date_format:H:i','required'],
			'notes' => ['string','nullable'],
			'noOfDrugs' => ['integer','required'],
        ];
		
		$this->validate($request, $rules);

        $prescription = Prescription::create([
			'doctor_appointment_id' => (int) $request->input('appointment_id'),
			'condition' => $request->input('condition'),
			'notes' => $request->input('notes'),
		]);
		
		$request->session()->flash('noOfDrugs',$request->input('noOfDrugs'));
		
		return redirect()->action('DoctorController@showDrugsForm',['id'=>\Auth::user()->doctor->id,'prescription_id'=>$prescription->id]);
	}

	public function updatePrescription(Request $request){
		$rules = [
			'condition' => ['date_format:H:i','required'],
			'notes' => ['string','nullable'],
			'drugName' => ['string','required'],
			'dose' => ['string','required'],
        ];
		
		$this->validate($request, $rules);

        $prescription = Prescription::find($request->input('prescription_id'));
		$prescription->notes = $request->input('notes');
		$prescription->condition = $request->input('condition');
		$prescription->save();

		dd($request->input('drugName'));
		
		return redirect()->action('DoctorController@showDrugsForm',['id'=>\Auth::user()->doctor->id,'prescription_id'=>$prescription->id]);
	}

	public function showDrugsForm(Request $request,$id,$prescription_id){
		$noOfDrugs = $request->session()->get('noOfDrugs');
		return view('doctor.addDrugs',[
			'prescription_id' => $prescription_id,
			'noOfDrugs' => $noOfDrugs,
		]);
	}
	public function addDrugs(Request $request){
		dd($request->all());
	}

	public function showLabAppointmentForm($id,$appointment_id){
		$prescription_id = Prescription::where('doctor_appointment_id',$appointment_id)->first()->id;
		$doctorAppointment = DoctorAppointment::find($appointment_id);
		$patient_id = $doctorAppointment->patient->id;
		$tests = LabTest::all();
		$helpingStaffs = HelpingStaff::where('role','ls')->get();

		return view('doctor.labAppointmentForm',[
			'prescription_id' => $prescription_id,
			'tests' => $tests,
			'patient_id' => $patient_id,
			'appointment_id' => $appointment_id,
			'helpingStaffs' => $helpingStaffs,
			'doctor_id' => $id,
		]);
	}

	public function addAppointment($id){
		$patient = Patient::all();
		return view('doctor.appointment',
			[
				'patient' => $patients,
			]
		);
	}
	public function showAppointment($id,$appointment_id){
		$patient = Patient::all();
		$appointment = DoctorAppointment::find($appointment_id);
		return view('doctor.appointment',
			[
				'patient' => $patients,
				'docAppointment' => $appointment
			]
		);
	}

	public function updateAppointment(Request $request){
		$rules = [
			'appointmentTime' => ['date_format:H:i'],
			'appointmentDate' => ['date_format:Y-m-d'],
			'notes' => ['string','nullable'],
		];
		
		$this->validate($request, $rules);

		$fomratted_start_date = Carbon::parse($request->input('appointmentDate') . $request->input('appointmentTime'));

		$appointment = DoctorAppointment::find($request->input('appointment_id'));
		$appointment->time = $fomratted_start_date;
		$appointment->notes = $request->input('notes');
		$appointment->save();

		return redirect()->action('DoctorController@index');
	}

	public function patientInfo(){
		return view('doctor.patientInfo');
	}
	public function labReports(){
		return view('doctor.labReports');
	}
}
