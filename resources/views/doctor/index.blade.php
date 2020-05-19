@extends('layouts.app')

@section('content')
<div class="docHeader">
    <h1>Mr. {{Auth::user()->name}}'s Dashboard</h1>
</div>
<div class="mainContent docContent">
    <article>
        <h2>Upcoming Appointments</h2>
        <section class="cards upcoming-appointments">
            @if(!$docAppointments->isEmpty())
                @foreach( $docAppointments as $docAppointment)
                <div class="card appointment">
					<h3>Patient's Name: {{$docAppointment->patient->user->name}}</h3>
					<div class="appointment-content">
						<div class="appointment-text">
							<p>Patient's Age: {{$docAppointment->patient->user->age}}</p>
							@if($docAppointment->notes)
								<p>Ailment Notes: {{$docAppointment->notes}}</p>
							@endif
							<span>Time and Date: {{$docAppointment->time}}</span>
						</div>
						<div class="actionable">
							<a class="btn btn-danger" href="{{action('DoctorController@showAppointment',['id'=>\Auth::user()->doctor->id,'appointment_id'=> $docAppointment->id])}}">
								@if($docAppointment->approved)
									Cancel
								@else
									Approve
								@endif
							</a>
							<a class="btn btn-danger" href="{{action('DoctorController@patientInfo',['id'=> Auth::user()->id,'patient_id'=> $docAppointment->patient->id])}}">View Patient Profile</a>
						</div>
					</div>
                </div>
                @endforeach
            @else
                <p>No Upcoming Appointments</p>
                
            @endif 
            <a href="{{action('DoctorController@addAppointment',['id'=>Auth::user()->doctor->id])}}" class="btn btn-danger addAppointment">Add New Appointment</a>
		</section>

        
		
		<h2>Previous Appointments</h2>
        <section class="cards upcoming-appointments">
            @if(!$prevDocAppointments->isEmpty())
                @foreach($prevDocAppointments as $docAppointment)
                <div class="card appointment">
						
                            <h3>Patient's Name: {{$docAppointment->patient->user->name}}</h3>
                            <div class="appointment-content">
                                <div class="appointment-text">
									<p>Patient's Age: {{$docAppointment->patient->user->age}}</p>
									@if($docAppointment->notes)
										<p>Ailment Notes: {{$docAppointment->notes}}</p>
									@endif
                                    <span>Time and Date: {{$docAppointment->time}}</span>
                                </div>
                                <div class="actionable">
									<a class="btn btn-danger" href="{{action('DoctorController@viewPrescription',['id'=> Auth::user()->doctor->id,'appointment_id'=> $docAppointment->id])}}">View Prescription</a>
									<a class="btn btn-danger" href="{{action('DoctorController@patientInfo',['id'=> Auth::user()->id,'patient_id'=> $docAppointment->patient->id])}}">View Patient Profile</a>
								</div>
                            </div>
                </div>
                @endforeach
            @else
                <p>No Previous Appointments</p>
                
            @endif 
		</section>


    </article>
</div>
@endsection
{{--% endblock %--}}
