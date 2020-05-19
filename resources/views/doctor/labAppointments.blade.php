@extends('layouts.app')
@section('content')
<div class="patientPage">
<div class="patientHeader">
    <h1>Mr. {{Auth::user()->name}}'s Dashboard</h1>
</div>

<div class="mainContent patientContent">
    <article>
		@if(\Auth::user()->patient){
			<a  href=" {{action('PatientController@showBill',['id'=>\Auth::user()->patient->id])}}" class="btn btn-danger">Show Bill</a>
		}
		 <h2>Lab's Appointments for Prescription</h2>
        <section class="cards upcoming-appointments">
            @if(!$labAppointments->isEmpty())
                @foreach($labAppointments as $labAppointment)
                <div class="card appointment">
					<h3>Conductor's Name: {{$labAppointment->helpingStaff->user->name}}</h3>
					<div class="appointment-content">
						<div class="appointment-text">
							<p>Time and Date: {{$labAppointment->time}}</p>
							<p>Test: {{$labAppointment->test->name}}</p>
						</div>
						<div class="actionable">
							@if(\Auth::user()->patient)
								<a class="btn btn-danger" href="{{action('PatientController@showLabReport',['id'=>\Auth::user()->patient->id,'appointment_id'=>$labAppointment->id])}}">Show Lab Report</a>
							@elseif(\Auth::user()->doctor)
								<a class="btn btn-danger" href="{{action('DoctorController@showLabReport',['id'=>\Auth::user()->doctor->id,'appointment_id'=>$labAppointment->id])}}">Show Lab Report</a>
							@endif
						</div>
					</div>
                </div>
                @endforeach
            @else
                <p>No Lab Appointments Found for this Prescription</p>
            @endif
        </section>      
    </article>
</div>
</div>

@endsection
