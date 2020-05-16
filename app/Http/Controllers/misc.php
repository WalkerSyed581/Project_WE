<?php
/*Patient Area
<?php

namespace App\Http\Controllers;
use App\Patient;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PatientController extends Controller
{
public function index(){
		$patient = Patient::where('user_id',\Auth::user()->id)->first();
		$docAppointments = $patient->doctorAppointments()->where([
			['cancelled','=',false],
			['time','>=',Carbon::now()->toTimeString()],
		])->get();
		dd($docAppointments);
        return view('patient.index');
	}
	public function getAppointment(){
        return view('patient.getAppointment');
	}
	public function showBill(){
        return view('patient.bill');
	}
	public function joinSupportGroup(){
        return view('patient.joinSupportGroup');
	}
	public function showLabReport(){
        return view('patient.labReport');
	}
   
	
}

	*/

	// namespace App\Http\Controllers;
	
	// use Illuminate\Http\Request;
	
	// class DoctorController extends Controller
	// {
	// 	public function index(){
	// 		return view('doctor.index');
	// 	}
	// 	public function patientInfo(){
	// 		return view('doctor.patientInfo');
	// 	}
	// 	public function labReports(){
	// 		return view('doctor.labReports');
	// 	}
		
	// }
	
	

?>