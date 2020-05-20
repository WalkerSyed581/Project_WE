@extends('layouts.app')
@section('content')
<div class="patientPage container-fluid col-md-12">
    <div class="row">
    <div class="patientHeader col-md-3 bg-dark" >
        <h1 class="text-center " style="color:white">{{Auth::user()->name}}</h1>
        <aside class="col-md-3 p-0 flex-shrink-1 sticky-top" style="margin-top:30px">
            <nav class="navbar navbar-expand navbar-dark  flex-md-column flex-row align-items-start py-2">
                <div class="collapse navbar-collapse">
                    <ul class="flex-md-column flex-row navbar-nav w-100 justify-content-between ">
                        
                        <li class="nav-item">
                            <a class="nav-link pl-0" href=" /Project_WE/public/doctor/addPrescription"><i class="fa fa-book fa-fw"></i> <span class="d-none d-md-inline">Add Prescription</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-0" href=" /Project_WE/public/doctor/addDrugs"><i class="fa fa-cog fa-fw"></i> <span class="d-none d-md-inline">Add Drugs</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-0" href=" /Project_WE/public/doctor/addLabAppointment"><i class="fa fa-heart codeply fa-fw"></i> <span class="d-none d-md-inline">Add Lab Appointment</span></a>
                        </li>
                                      
                    </ul>
                </div>
            </nav>
        </aside>
    </div> 

<div class="mainContent patientContent col-md-9">
    <article>
		@if(\Auth::user()->patient){
			<a  href=" {{action('PatientController@showBill',['id'=>\Auth::user()->patient->id])}}" class="btn btn-danger">Show Bill</a>
		}
		 <h2>Lab's Appointments for Prescription</h2>
        <section class="cards upcoming-appointments">
            @if(!$labAppointments->isEmpty())
            <table class="table">
                <tr>
                    <th>Conductor's Name</th>
                    <th>Time and Date</th>
                    <th>Test</th>
                    <th>Lab Report</th>
                </tr>
                @foreach($labAppointments as $labAppointment)
                <tr>
                    <td>{{$labAppointment->helpingStaff->user->name}}</td>
                    <td>{{$labAppointment->time}}</td>
                    <td>{{$labAppointment->test->name}}</td>
                    <td>@if(\Auth::user()->patient)
                        <a class="btn btn-primary" href="{{action('PatientController@showLabReport',['id'=>\Auth::user()->patient->id,'appointment_id'=>$labAppointment->id])}}">Show Lab Report</a>
                    @elseif(\Auth::user()->doctor)
                        <a class="btn btn-primary" href="{{action('DoctorController@showLabReport',['id'=>\Auth::user()->doctor->id,'appointment_id'=>$labAppointment->id])}}">Show Lab Report</a>
                    @endif</td>
                </tr>
            
                
                @endforeach
                </table>
            @else
                <p>No Lab Appointments Found for this Prescription</p>
            @endif
        </section>      
    </article>
</div>
</div>
</div>

@endsection
