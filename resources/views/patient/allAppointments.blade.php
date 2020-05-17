@extends('layouts.app')
@section('content')
<div class="patientPage">
<div class="patientHeader">
    <h1>Mr. {{Auth::user()->name}}'s Dashboard</h1>
</div>

<div class="mainContent patientContent">
    <article>
        <a  href=" {{action('PatientController@showBill',['id'=>Auth::user()->id])}}" class="btn btn-danger">Show Bill</a>

        <h2>Upcoming Doctor's Appointments</h2>
        <section class="cards upcoming-appointments">
            @if($docAppointments)
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
                                    <a class="btn btn-danger" href="{{action('DoctorAppointmentController@destroy',['id'=>$docAppointment->id])}}">Cancel</a>
                                </div>
                            </div>
                </div>
                @endforeach
            @else
                <p>No Upcoming Appointments</p>
                
            @endif 
            <a href="{{action('PatientController@showAppointmentForm',['id'=>Auth::user()->id])}}" class="btn btn-danger addAppointment">Add New Appointment</a>
        </section>

        <h2>Upcoming Lab's Appointments</h2>
        <section class="cards upcoming-appointments">
            @if($labAppointments)
                @foreach($labAppointments as $labAppointment)
                <div class="card appointment">
					<h3>Conductor's Name: {{$labAppointment->helpingStaff->user->name}}</h3>
					<div class="appointment-content">
						<div class="appointment-text">
							<span>Time and Date: {{$labAppointment->time}}</span>
						</div>
						<div class="actionable">
							<a class="btn btn-danger" href="{{action('LabAppointmentController@destroy',['id'=>$docAppointment->id])}}">Cancel</a>
						</div>
					</div>
                </div>
                @endforeach
            @else
                <p>No Upcoming Lab Appointments</p>
            @endif
        </section>      
    </article>
</div>
</div>

@endsection
