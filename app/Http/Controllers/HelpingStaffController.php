<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HelpingStaff;
use App\User;
use App\DoctorAppointment;
use App\Admission;
use App\LabTest;
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
		$labAppointments = $duties = $docAppointments = $prevLabAppointments = [];
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

		} elseif($helpingStaff->role =='ws') {

			$duties = $helpingStaff->admissions()->where([
				['discharged','=',false],
			])->get();

			
		} elseif($helpingStaff->role =='rc'){

			$docAppointments = DoctorAppointment::where([
				['cancelled','=',false],
				['time','>=',$currentTime],
			])->get();

		}

		return view('helpingStaff.index',[
			'labAppointments' => $labAppointments,
			'prevLabAppointments' => $prevLabAppointments,
			'duties' => $duties,
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
	
	public function addLabReport($id,$labAppointment_id){
		$labReport = LabReport::where('lab_appointment_id',$labAppointment_id)->first();
		return view('helpingStaff.labReport',[
			'labReport' => $labReport,
			'labAppointment_id' => $labAppointment_id,
		]);
	}
	public function storeLabReport(Request $request){
		$rules = [
			'labReport' => ['string','integer','required'],
		];
		$this->validate($request, $rules);
		$labReport = LabReport::create([
			'lab_appointment_id' => $request->input('labAppointment_id'),
			'report_text' => $request->input('labReport'),
		]);

		return redirect()->action('HelpingStaf@index');
	}
	public function updateLabReport(Request $request){
		$rules = [
			'labReport' => ['string','integer','required'],
		];
		$this->validate($request, $rules);
		$labReport = LabReport::find($request->input('labReport_id'));
		$labReport->report_text = $request->input('labReport');
		$labReport->save();

		return redirect()->action('HelpingStaff@index');
	}

	public function showLabAppointment($id,$labAppointment_id){
		$labAppointment = LabAppointment::find($labAppointment_id);
		$tests = LabTest::all();
		return view('helpingStaff.labAppointment',[
			'labAppointment' => $labAppointment,
			'tests' => $tests,
		]);
	}
	public function updateLabAppointment(Request $request){
		$rules = [
			'appointmentTime' => ['date_format:H:i'],
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
		$appointment->save();

		return redirect()->action('HelpingStaff@index');
	}
}
