<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SupportGroup;
use App\Patient;
use App\Doctor;
use App\DoctorAppointment;
use App\LabAppointment;
use App\HelpingStaff;
use App\Admission;
use Carbon\Carbon;
use App\SupportGroupConductor;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$patients = Patient::oldest()->get();
		$docAppointments = DoctorAppointment::oldest()->get();
		$labAppointments = LabAppointment::oldest()->get();
		$admissions = Admission::oldest()->get();
		$doctors = Doctor::oldest()->get();
		$patientMonths = $appointmentMonths = $admissionMonths = $doctorMonths = [];
		if($patients){
			foreach($patients as $patient){
				$created_at = Carbon::parse($patient->created_at);
				$created_at = $created_at->format('d F');
				if(!in_array($created_at,$patientMonths)){
					$patientMonths[$created_at] = 1;
				} else {
					$patientMonths[$created_at] = $patientMonths[$created_at] + 1;
				}
			}
		}
		if($doctors){
			foreach($doctors as $doctor){
				$created_at = Carbon::parse($doctor->created_at);
				$created_at = $created_at->format('d F');
				if(!in_array($created_at,$doctorMonths)){
					$doctorMonths[$created_at] = 1;
				} else {
					$doctorMonths[$created_at] = $doctorMonths[$created_at] + 1;
				}
			}
		}
		if($docAppointments){
			foreach($docAppointments as $docAppointment){
				$created_at = Carbon::parse($docAppointment->created_at);
				$created_at = $created_at->format('d F');
				if(!in_array($created_at,$appointmentMonths)){
					$appointmentMonths[$created_at] = 1;
				} else {
					$appointmentMonths[$created_at] = $appointmentMonths[$created_at] + 1;
				}
			}
		}
		if($labAppointments){
			foreach($labAppointments as $labAppointment){
				$created_at = Carbon::parse($labAppointment->created_at);
				$created_at = $created_at->format('d F');
				if(!in_array($created_at,$appointmentMonths)){
					$appointmentMonths[$created_at] = 1;
				} else {
					$appointmentMonths[$created_at] = $appointmentMonths[$created_at] + 1;
				}
			}
		}
		if($admissions){
			foreach($admissions as $admission){
				$created_at = Carbon::parse($admission->created_at);
				$created_at = $created_at->format('d F');
				if(!in_array($created_at,$admissionMonths)){
					$admissionMonths[$created_at] = 1;
				} else {
					$admissionMonths[$created_at] = $admissionMonths[$created_at] + 1;
				}
			}
		}


        return view('admin.index',[
			'patientCount' => array_values($patientMonths),
			'patientMonths' => array_keys($patientMonths),
			'doctorCount' => array_values($doctorMonths),
			'doctorMonths' => array_keys($doctorMonths),
			'appointmentCount' => array_values($appointmentMonths),
			'appointmentMonths' => array_keys($appointmentMonths),
			'admissionCount' => array_values($admissionMonths),
			'admissionMonths' => array_keys($admissionMonths),
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
        //
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
	
	//Register any user
	// public function showRegisterForm($id){
    //     return view('admin.register')->with('id',$id);
	// }

	public function showRegisterForm($id){
		return view('admin.register');
	}
	
	public function showSupportGroups($id){
		$supportGroups = SupportGroup::all();
		return view('patient.joinSupportGroup',[
			'supportGroups' => $supportGroups,
		]);
	}

	public function showSupportGroupForm($id){
		$supportGroup = [];
		$supportGroupConductors = SupportGroupConductor::all();
		$days = [
			'Sunday',
			'Monday',
			'Tuesday',
			'Wednesday',
			'Thursday',
			'Friday',
			'Saturday',
		];
		return view('admin.addSupportGroup',[
			'supportGroup' => $supportGroup,
			'supportGroupConductors' => $supportGroupConductors,
			'days' => $days,
		]);
	}

	//Add data specific to the role
	public function showRoleForm($id,$user_id,$role){
		$roleData = [];
		switch($role){
			case 'p':
				$roleData = Patient::where('user_id',$user_id)->first();
				break;
			case 'd':
				$roleData = Doctor::where('user_id',$user_id)->first();
				break;
			case 'hs':
				$roleData = HelpingStaff::where('user_id',$user_id)->first();
				break;
			case 'sgc':
				$roleData = SupportGroupConductor::where('user_id',$user_id)->first();
				break;
		}
		return view('admin.addRoleData',[
			'user_id'=>$user_id,
			'role'=>$role,
			'roleData' => $roleData,
		]);
	}



	
	
	public function registerRoleData(Request $request){
		$role = $request->post()['role'];

		if($role=='p'){
			return redirect()->action('DoctorController@store');
		}elseif($role=='d'){
			return redirect()->action('DoctorController@store');
		} elseif($role=='hs'){
			// return redirect()->action('DoctorController@store');
		}elseif($role=='sgc'){

		}elseif($role=='a'){
			
		} 
	}

}
