<?php

namespace App\Http\Controllers;
use App\User;
use App\Patient;
use Carbon\Carbon;
use App\Drug;
use App\LabReport;
use App\Bill;
use App\Doctor;
use App\Prescription;
use App\SupportGroup;
use App\DoctorAppointment;
use App\LabAppointment;
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
    public function update(Request $request, $patient_id)
    {
        $rules = [
			'emergencey_contact' => ['string','digits:11'],
        ];

		$this->validate($request, $rules);

        $patient = Patient::find($patient_id);
		$patient->emergencey_contact = $request->input('emergencey_contact');
		$patient->save();
		
		return redirect()->action('UsersController@index',['id'=>\Auth::id()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id,$patient_id)
    {
		Patient::find($patient_id)->delete();
		User::find($user_id)->delete();

		return redirect()->action('UsersController@index',['id'=>\Auth::id()]);		
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
		$patient = Patient::find($id);
		$currentTime = Carbon::now()->toDateTimeString();

		$docAppointments = $patient->doctorAppointments()->where([
			['time','<',$currentTime],
		])->orWhere([
			['cancelled','=',true],
		])->get();

		$labAppointments = $patient->labAppointments()->where([
			['time','<',$currentTime],
		])->orWhere([
			['cancelled','=',true],
		])->get();

        return view('patient.allAppointments',[
			'docAppointments' => $docAppointments,
			'labAppointments' => $labAppointments,
		]);
	}
	public function showPrescription($id,$appointment_id){
		$prescription = Prescription::where('doctor_appointment_id',$appointment_id)->first();
		$drugs = $doctorName = [];
		if($prescription){
			$drugs = $prescription->drugs()->get();
			$doctorAppointment = DoctorAppointment::find($appointment_id);
			$doctorName = $doctorAppointment->doctor->user->name;
		}
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

	

	public function showSupportGroups($id){
		$supportGroups = SupportGroup::all();
		return view('patient.joinSupportGroup',[
			'supportGroups' => $supportGroups,
		]);
	}
	public function joinSupportGroup($id,$supportGroup_id){
		$patient = Patient::find($id);

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
			'type' => 'cur',
		]);
	}

	public function showAllAdmissions($id){
		$patient = Patient::where('id',$id)->first();
		$admissions = $patient->admissions;

		return view('patient.admission',[
			'admissions' => $admissions,
			'type' => 'old',
		]);
	}

	private function calculateBill($id){
		$currentTime = Carbon::now()->toDateTimeString();
		$bills = Bill::where('patient_id',$id)->get();
		if($bills->isEmpty()){
			return false;
		}
		$patient = Patient::find($id);
		$totalSupportGroupFee =0;
		$supportGroup = [];
		if($patient->supportGroup){
			$supportGroups = $patient->supportGroup->get();
			foreach($supportGroups as $supportGroup){
				$totalSupportGroupFee = $totalSupportGroupFee + $supportGroup->fee;
			}
		}
		$doctorfee = 0;
		$wardFee = 0;
		$totalFee=0;
		$totalLabFee=0; 
		$testIndex = 0;
		$supportGroupFee = 0;
		$labFee = array();
		
		
		

		foreach($bills as $bill){
			if($bill->doctorAppointment){
				$doctorfee = $doctorfee + $bill->doctorAppointment->doctor->fee;
			}
			elseif($bill->labAppointment){
				$labFee[$testIndex]['name'] = $bill->labAppointment->labTest->name;
				$labFee[$testIndex]['fee'] = $bill->labAppointment->labTest->fee;
				$totalLabFee = $totalLabFee + $labFee[$testIndex]['fee'];
				$testIndex++;
			}
			elseif($bill->admission){
				$wardFee = $wardFee +($bill->admission->ward->capacity * $bill->admission->number_of_days);
			}
		}
		
		

		$totalFee = $wardFee + $totalLabFee + $totalSupportGroupFee + $doctorfee;
		return [
			"doctorFee"=> $doctorfee,
			"wardFee" => $wardFee,
			"testFees"=>$labFee,
			"totalTestFee"=>$totalLabFee,
			"supportGroupFee"=>$totalSupportGroupFee,
			"totalFee"=> $totalFee,
		];
		
	}

	public function showBill($id){
		$fees = $this->calculateBill($id);
		return view('patient.bill',[
			'fees'=>$fees,
		]);
	}

	public function showLabReport($id,$appointment_id){
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
	public function showPrescriptionAppointments($id,$prescription_id){
		$labAppointments = LabAppointment::where('prescription_id',$prescription_id)->get();
		return view('doctor.labAppointments',[
			'labAppointments' => $labAppointments,
		]);
	}

	
	
}
