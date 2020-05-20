<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Doctor;
use App\User;
use App\LabTest;
use App\Patient;
use App\DoctorAppointment;
use App\Ward;
use App\Drug;
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
		$docAppointments = $doctor->doctorAppointments()->where([
			['cancelled','=',false],
			['time','>=',$currentTime],
		])->get();



		$prevDocAppointments = $doctor->doctorAppointments()->where([
			['cancelled','=',false],
			['approved','=',true],
			['time','<=',$currentTime],
		])->get();

		
        return view('doctor.index',[
			'docAppointments' => $docAppointments,
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
    public function update(Request $request, $doctor_id)
    {
        $rules = [
			'salary' => ['string','integer','required'],
			'specialization' => ['string'],
			'fee' => ['string','integer','required'],
			'start_time' => ['required','date_format:H:i:s'],
			'end_time' => ['required','date_format:H:i:s','after:start_time'],
		];
		
		$this->validate($request, $rules);

		$start_time = explode(':',$request->input('start_time'));
		$fomratted_start_time = Carbon::now();
		$fomratted_start_time->hour = (int) $start_time[0];
		$fomratted_start_time->minute = (int) $start_time[1];
		$fomratted_start_time->second = (int) $start_time[2];


		$end_time = explode(':',$request->input('end_time'));
		$fomratted_end_time = Carbon::now();
		$fomratted_end_time->hour = (int) $end_time[0];
		$fomratted_end_time->minute = (int) $end_time[1];
		$fomratted_end_time->second = (int) $start_time[2];
		


		$doctor = Doctor::find($doctor_id);
		
		$doctor->salary = $request->input('salary');
		$doctor->specialization = $request->input('specialization');
		$doctor->fee = $request->input('fee');
		$doctor->starting_time = $fomratted_start_time->format('H:i:s');
		$doctor->end_time = $fomratted_end_time->format('H:i:s');
		$doctor->save();		
		
		return redirect()->action('UsersController@index',['id'=>\Auth::id()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id,$doctor_id)
    {
		Doctor::find($doctor_id)->delete();
		User::find($user_id)->delete();

		return redirect()->action('UsersController@index',['id'=>\Auth::id()]);		
	}
	


	public function viewPrescription($id,$appointment_id){
		$prescription = Prescription::where('doctor_appointment_id',$appointment_id)->first();
		$drugs = [];
		if($prescription){
			$drugs = $prescription->drugs;
		}
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
			'condition' => ['required','string'],
			'notes' => ['string','nullable'],
			'numberOfDrugs' => ['integer','required'],
        ];

		$this->validate($request, $rules);
        $prescription = Prescription::create([
			'doctor_appointment_id' => (int) $request->input('appointment_id'),
			'condition' => $request->input('condition'),
			'notes' => $request->input('notes'),
		]);
		
		
		return redirect()->action('DoctorController@showDrugsForm',['id'=>\Auth::user()->doctor->id,'prescription_id'=>$prescription->id,'number_of_drugs'=>$request->input('numberOfDrugs')]);
	}

	public function updatePrescription(Request $request){
		$rules = [
			'condition' => ['string','required'],
			'notes' => ['string','nullable'],
		];
		for($i = 0;$i < $request->input('number_of_drugs');$i++){
			$rules['drugName'.$i] = ['string','required'];
			$rules['dose'.$i] = ['string','required'];
		}
		
		$this->validate($request, $rules);

        $prescription = Prescription::find($request->input('prescription_id'));
		$prescription->notes = $request->input('notes');
		$prescription->condition = $request->input('condition');
		$prescription->save();

		for($i = 0;$i < $request->input('number_of_drugs');$i++){
			$drug = Drug::find($request->input('drug_id'.$i));
			$drug->name = $request->input('drugName'.$i);
			$drug->dose = $request->input('dose'.$i);
			$drug->save();
		}

		return redirect()->action('DoctorController@viewPrescription',['id'=>\Auth::user()->doctor->id,'appointment_id'=>$request->input('appointment_id')]);
	}

	public function showDrugsForm($id,$prescription_id,$number_of_drugs){
		return view('doctor.addDrugs',[
			'doctor_id' => $id,
			'prescription_id' => $prescription_id,
			'noOfDrugs' => $number_of_drugs,
		]);
	}
	public function addDrugs(Request $request){
		$prescription = Prescription::find($request->input('prescription_id'));

		$rules=[];
		for($i = 0;$i < $request->input('number_of_drugs');$i++){
			$rules['drugName'.$i] = ['string','required'];
			$rules['dose'.$i] = ['string','required'];
		}
		$this->validate($request,$rules);
		for($i = 0;$i < $request->input('number_of_drugs');$i++){
			$drug = Drug::create([
				'prescription_id'=> $request->input('prescription_id'),
				'name' => $request->input('drugName'.$i),
				'dose' => $request->input('dose'.$i),
			]);
		}
		return redirect()->action('DoctorController@viewPrescription',['id'=>$request->input('doctor_id'),'appointment_id'=>$prescription->doctor_appointment_id]);
		
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
		$patients = Patient::all();
		$docAppointment = [];
		return view('doctor.appointment',
			[
				'patients' => $patients,
				'docAppointment' => $docAppointment,
			]
		);
	}
	public function showAppointment($id,$appointment_id){
		$patients = Patient::all();
		$appointment = DoctorAppointment::find($appointment_id);
		return view('doctor.appointment',
			[
				'patients' => $patients,
				'docAppointment' => $appointment,
			]
		);
	}

	public function updateAppointment(Request $request){
		$rules = [
			'appointmentTime' => ['date_format:H:i:s'],
			'appointmentDate' => ['date_format:Y-m-d'],
			'notes' => ['string','nullable'],
		];
		
		$this->validate($request, $rules);
		$fomratted_start_date = Carbon::parse($request->input('appointmentDate') . $request->input('appointmentTime'));
		$appointment = DoctorAppointment::find($request->input('appointment_id'));
		$appointment->time = $fomratted_start_date;
		$appointment->notes = $request->input('notes');
		$appointment->approved =(boolean) $request->input('approved');
		$appointment->save();

		return redirect()->action('DoctorController@index');
	}


	public function showAdmitForm($id,$patient_id){
		$patient = Patient::find($patient_id);
		$admission = $patient->admissions()->where('discharged','false')->first();
		$wards = Ward::all();
		$helpingStaffs = HelpingStaff::where('role','ws')->get();
		return view('doctor.admission',[
			'patient' => $patient,
			'wards' => $wards,
			'helpingStaffs'=> $helpingStaffs,
			'admission' => $admission,
		]);
	}


	public function patientInfo($user_id,$patient_id){
		$patient = Patient::find($patient_id);
		$docAppointments = $patient->doctorAppointments()->latest()->get();
		
		return view('doctor.patientInfo',[
			'patient' => $patient,
			'docAppointments' => $docAppointments,
		]);
	}
	public function showLabReport($id,$prescription_id,$appointment_id){
		$labAppointment = LabAppointment::find($appointment_id);
		$labReport = LabReport::where('lab_appointment_id',$appointment_id)->first();
		$patient = $labAppointment->patient;
		$prescription = $labAppointment->prescription;
		$drugs = $prescription->drugs()->get();
		return view('doctor.labReport',[
			'labReport' => $labReport,
			'labAppointment' => $labAppointment,
			'patient' => $patient,
			'prescription' => $prescription,
			'drugs' => $drugs,
		]);
	}

	public function showLabAppointments($id,$prescription_id){
		$labAppointments = LabAppointment::where('prescription_id',$prescription_id)->get();
		return view('doctor.labAppointments',[
			'labAppointments' => $labAppointments,
		]);	}
}
