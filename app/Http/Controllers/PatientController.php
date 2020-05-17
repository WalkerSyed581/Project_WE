<?php

namespace App\Http\Controllers;
use App\User;
use App\Patient;
use Carbon\Carbon;
use App\Drug;
use App\Doctor;
use App\Prescription;
use App\SupportGroup;
use App\DoctorAppointment;
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
		$patient = Patient::where('user_id',\Auth::user()->id)->first();
		$currentTime = Carbon::now()->toDateTimeString();

		$docAppointments = $patient->doctorAppointments()->where([
			['cancelled','=',false],
			['approved','=',true],
			['time','>=',$currentTime],
		])->get();

		$labAppointments = $patient->labAppointments()->where([
			['cancelled','=',false],
			['approved','=',true],
			['time','>=',$currentTime],
		])->get();
		$supportGroups = $patient->supportGroups()->get();

		
        return view('patient.index',[
			'docAppointments' => $docAppointments,
			'labAppointments' => $labAppointments,
			'supportGroups' => $supportGroups,
		]);
	}
	public function appoinmentArchive($id){
		$patient = Patient::where('user_id',$id)->first();
		$currentTime = Carbon::now()->toDateTimeString();

		$docAppointments = $patient->doctorAppointments()->where([
			['time','<',$currentTime],
		])->orWhere([
			['cancelled','=',true],
		])->get();

		$labAppointments = $patient->labAppointments()->where([
			['time','<',$currentTime],
		])->get();

        return view('patient.allAppointments',[
			'docAppointments' => $docAppointments,
			'labAppointments' => $labAppointments,
		]);
	}
	public function showPrescription($id,$appointment_id){
		$prescription = Prescription::where('doctor_appointment_id',$appointment_id)->first();
		$drugs = $prescription->drugs;
		$doctorAppointment = DoctorAppointment::find($appointment_id);
		$doctorName = $doctorAppointment->doctor->user->name;
		return view('patient.prescription',[
			'prescription' => $prescription,
			'drugs' => $drugs,
			'doctorName' => $doctorName,
		]);
	}

	public function showAppointmentForm($id){
		$doctors = Doctor::all();
		return view('patient.getAppointment',
			[
				'doctors' => $doctors,
			]
		);
	}
	public function showBill($id){
        return view('patient.bill');
	}
	public function showSupportGroups($id){
		$supportGroups = SupportGroup::all();
		return view('patient.joinSupportGroup',[
			'supportGroups' => $supportGroups,
		]);
	}
	public function joinSupportGroup($id,$supportGroup_id){
		$patient = Patient::where('user_id',$id)->first();

		if($patient->supportGroups->where('id',$supportGroup_id)->first()){
			return redirect()->action('PatientController@index');
		}

		$supportGroup = SupportGroup::where('id',$supportGroup_id)->first();

		$patient->supportGroups()->attach($supportGroup_id);

		return redirect()->action('PatientController@index');
	}

	public function leaveSupportGroup($id,$supportGroup_id){
		$patient = Patient::where('user_id',$id)->first();

		$patient->supportGroups()->detach($supportGroup_id);

		return redirect()->action('PatientController@index');
	}
	
	public function showCurrentAdmission($id){
		$patient = Patient::where('id',$id)->first();
		$admissions = $patient->admissions()->where('discharged',false)->get();
		return view('patient.admission',[
			'admissions' => $admissions,
		]);
	}

	public function showAllAdmissions($id){
		$patient = Patient::where('id',$id)->first();
		$admissions = $patient->admissions;
		dd($admissions);

		return view('patient.admission',[
			'admissions' => $admissions,
		]);
	}
}
