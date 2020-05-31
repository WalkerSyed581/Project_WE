<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HelpingStaff;
use App\User;
use App\DoctorAppointment;
use App\Admission;
use App\LabTest;
use App\Ward;
use App\LabAppointment;
use App\LabReport;
use Carbon\Carbon;

class HelpingStaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$helpingStaff = HelpingStaff::find(\Auth::user()->helpingStaff->id);
		$labAppointments = $duties = $docAppointments = $prevLabAppointments = $tests = $wards = [];
		$currentTime = Carbon::now()->toDateTimeString();

		if($helpingStaff->role == 'ls'){

			$labAppointments = $helpingStaff->labAppointments()->where([
				['cancelled','=',false],
				['time','>=',$currentTime],
			])->get();

			$prevLabAppointments = $helpingStaff->labAppointments()->where([
				['cancelled','=',false],
				['approved','=',true],
				['time','<=',$currentTime],
			])->get();

			$tests = LabTest::all();

		} elseif($helpingStaff->role =='ws') {

			$duties = $helpingStaff->admissions()->where([
				['discharged','=',false],
			])->get();

			$wards = Ward::all();
			
		} elseif($helpingStaff->role =='rc'){

			$docAppointments = DoctorAppointment::where([
				['cancelled','=',false],
				['time','>=',$currentTime],
			])->get();

		}

		return view('helping_staff.index',[
			'labAppointments' => $labAppointments,
			'prevLabAppointments' => $prevLabAppointments,
			'duties' => $duties,
			'tests' => $tests,
			'wards' => $wards,
			'docAppointments' => $docAppointments,
			'role' => \Auth::user()->helpingStaff->role,
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
			'role' => ['required'],
        ];

		$this->validate($request, $rules);

        $patient = HelpingStaff::create([
			'salary' => $request->input('salary'),
			'role' => $request->input('role'),
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
    public function update(Request $request, $helpingStaff_id)
    {
		$rules = [
			'salary' => ['string','integer','required'],
			'role' => ['required'],
        ];

		$this->validate($request, $rules);

        $helpingStaff = HelpingStaff::find($helpingStaff_id);
		$helpingStaff->salary = $request->input('salary');
		$helpingStaff->role = $request->input('role');
		$helpingStaff->save();
		
		return redirect()->action('UsersController@index',['id'=>\Auth::id()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id,$helpingStaff_id)
    {
		HelpingStaff::find($helpingStaff_id)->delete();
		User::find($user_id)->delete();

		return redirect()->action('UsersController@index',['id'=>\Auth::id()]);		
	}
	
	public function addLabReport($id,$labAppointment_id){
		$labReport = LabReport::where('lab_appointment_id',$labAppointment_id)->first();
		return view('helping_staff.labReport',[
			'labReport' => $labReport,
			'labAppointment_id' => $labAppointment_id,
		]);
	}
	public function storeLabReport(Request $request){
		$rules = [
			'labReport' => ['string','required'],
		];
		$this->validate($request, $rules);
		$labReport = LabReport::create([
			'lab_appointment_id' => $request->input('appointment_id'),
			'report_text' => $request->input('labReport'),
		]);

		return redirect()->action('HelpingStaffController@index');
	}
	public function updateLabReport(Request $request){
		$rules = [
			'labReport' => ['string','required'],
		];
		$this->validate($request, $rules);
		$labReport = LabReport::find($request->input('labReport_id'));
		$labReport->report_text = $request->input('labReport');
		$labReport->save();

		return redirect()->action('HelpingStaffController@index');
	}

	public function showLabAppointment($id,$labAppointment_id){
		$labAppointment = LabAppointment::find($labAppointment_id);
		$tests = LabTest::all();
		return view('helping_staff.labAppointment',[
			'labAppointment' => $labAppointment,
			'tests' => $tests,
		]);
	}
	public function updateLabAppointment(Request $request){
		$rules = [
			'appointmentTime' => ['date_format:H:i:s'],
			'appointmentDate' => ['date_format:Y-m-d'],
			'notes' => ['string','nullable'],
			'lab_test_id' => ['required','integer'],
		];
		
		$this->validate($request, $rules);

		$fomratted_start_date = Carbon::parse($request->input('appointmentDate') . $request->input('appointmentTime'));
		$appointment = LabAppointment::find($request->input('appointment_id'));
		$appointment->time = $fomratted_start_date;
		$appointment->notes = $request->input('notes');
		$appointment->lab_test_id = $request->input('lab_test_id');
		$appointment->approved = (boolean) $request->input('approved');
		$appointment->save();

		return redirect()->action('HelpingStaffController@index');
	}

	public function showAdmitForm($id,$admission_id){
		$admission = Admission::find($admission_id);
		if(!$admission){
			return redirect()->action('HelpingStaff@index');
		}
		$patients = Patient::all();
		$wards = Ward::all();
		return view('doctor.admission',[
			'admission' => $admission,
			'patients' => $patients,
			'wards' => $wards,
		]);
	}

	public function showWardForm($id){
		$ward = [];
		return view('helping_staff.viewWard',[
			'ward' => $ward,
			'helping_staff_id' => $id,
		]);
	}
	public function storeWard(Request $request){
		$rules= [
			'capacity' => ['integer','required'],
		];
		$this->validate($request,$rules);

		$ward = Ward::create([
			'capacity' => $request->input('capacity'),
		]);

		return redirect()->action('HelpingStaffController@index');
	}
	public function showWard($id,$ward_id){
		$ward = Ward::find($ward_id);
		return view('helping_staff.viewWard',[
			'ward' => $ward,
			'helping_staff_id' => $id,
		]);
	}
	public function updateWard(Request $request){
		$rules= [
			'capacity' => ['integer','required'],
		];
		$this->validate($request,$rules);

		$ward = Ward::find($request->input('ward_id'));
		$ward->capacity =  $request->input('capacity');
		$ward->save();

		return redirect()->action('HelpingStaffController@index');
	}

	public function showTestForm($id){
		$test = [];
		return view('helping_staff.viewTest',[
			'test' => $test,
			'helping_staff_id' => $id,
		]);
	}
	public function storeTest(Request $request){
		$rules= [
			'name' => ['string','required'],
			'fee' => ['integer','required'],
			'description' => ['string','required'],
		];
		$this->validate($request,$rules);

		$test = LabTest::create([
			'name' => $request->input('name'),
			'fee' => $request->input('fee'),
			'description' => $request->input('description'),
		]);

		return redirect()->action('HelpingStaffController@index');
	}
	public function showTest($id,$test_id){
		$test = LabTest::find($test_id);
		return view('helping_staff.viewTest',[
			'test' => $test,
			'helping_staff_id' => $id,
		]);
	}
	public function updateTest(Request $request){
		$rules= [
			'name' => ['string','required'],
			'fee' => ['integer','required'],
			'description' => ['string','required'],
		];
		$this->validate($request,$rules);

		$test = LabTest::find($request->input('test_id'));
		$test->name =  $request->input('name');
		$test->fee = $request->input('fee');
		$test->description = $request->input('description');
		$test->save();

		return redirect()->action('HelpingStaffController@index');
	}
}

