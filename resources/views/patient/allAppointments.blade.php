@extends('layouts.app')
@section('content')
<div class="patientPage">
<div class="patientHeader">
    <h1>Mr. {{Auth::user()->name}}'s Dashboard</h1>
</div>

<div class="mainContent patientContent">
    <article>
        <a  href=" {{action('PatientController@showBill',['id'=>\Auth::user()->patient->id])}}" class="btn btn-danger">Show Bill</a>

        <h2>Previous Doctor's Appointments</h2>
        <section class="cards upcoming-appointments">
            @if(!$docAppointments->isEmpty())
                @foreach( $docAppointments as $docAppointment)
                <div class="card appointment">
						
                            <h3>Doctor's Name: {{$docAppointment->doctor->user->name}}</h3>
                            <div class="appointment-content">
                                <div class="appointment-text">
									<p>Doctor's Experise: {{$docAppointment->doctor->specialization}}</p>
									@if($docAppointment->notes)
										<p>Ailment Notes: {{$docAppointment->notes}}</p>
									@endif
                                    <span>Time and Date: {{$docAppointment->time}}</span>
                                </div>
                                <div class="actionable">
                                    <a class="btn btn-danger" href="{{action('PatientController@showPrescription',['id'=>\Auth::user()->patient->id,'appointment_id'=>$docAppointment->id])}}">View Prescription</a>
                                </div>
                            </div>
                </div>
                @endforeach
            @else
                <p>No Doctor Appointments Found</p>
                
            @endif 
        </section>

        <h2>Previous Lab's Appointments</h2>
        <section class="cards upcoming-appointments">
            @if(!$labAppointments->isEmpty())
                @foreach($labAppointments as $labAppointment)
                <div class="card appointment">
					<h3>Conductor's Name: {{$labAppointment->helpingStaff->user->name}}</h3>
					<div class="appointment-content">
						<div class="appointment-text">
							<span>Time and Date: {{$labAppointment->time}}</span>
						</div>
						<div class="actionable">
						<a class="btn btn-danger" href="{{action('PatientController@showLabReport',['id'=>\Auth::user()->patient->id,'appointment_id'=>$labAppointment->id])}}">Show Lab Report</a>
						</div>
					</div>
                </div>
                @endforeach
            @else
                <p>No Lab Appointments Found</p>
            @endif
        </section>      
    </article>
</div>
</div>

@endsection
