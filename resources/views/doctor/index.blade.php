@extends('layouts.app')

@section('content')
<div class="docHeader">
    <h1>Mr. {{Auth::user()->name}}'s Dashboard</h1>
</div>
<div class="mainContent docContent">
    <article>
        <h2>Upcoming Appointments</h2>
        <section class="cards upcoming-appointments">
            @if($docAppointments)
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
                                </div>
                            </div>
                </div>
                @endforeach
            @else
                <p>No Upcoming Appointments</p>
                
            @endif 
            <a href="{{action('DoctorController@showAppointmentForm',['id'=>Auth::user()->doctor->id])}}" class="btn btn-danger addAppointment">Add New Appointment</a>
		</section>

        
		
		<h2>Previous Appointments</h2>
        <section class="cards upcoming-appointments">
            @if($prevDocAppointments)
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
									<a class="btn btn-danger" href="{{action('DoctorController@viewPrescription',['id'=> Auth::user()->id,'appointment_id'=> $docAppointment->id])}}">View Prescription</a>
                                </div>
                            </div>
                </div>
                @endforeach
            @else
                <p>No Upcoming Appointments</p>
                
            @endif 
            <a href="{{action('DoctorController@showAppointmentForm',['id'=>Auth::user()->doctor->id])}}" class="btn btn-danger addAppointment">Add New Appointment</a>
		</section>

		<h2>Upcoming Lab's Appointments</h2>
        <section class="cards upcoming-appointments">
            @if($labAppointments)
                @foreach($labAppointments as $labAppointment)
                <div class="card appointment">
					<h3>Conductor's Name: {{$labAppointment->helpingStaff->user->name}}</h3>
					<div class="appointment-content">
						<div class="appointment-text">
							<p>Time and Date: {{$labAppointment->time}}</p>
							<p>Test: {{$labAppointment->labTest->name}}</p>
						</div>
						<div class="actionable">
							<a class="btn btn-danger" href="{{action('LabAppointmentController@destroy',['id'=>$labAppointment->id])}}">Cancel</a>
							<a class="btn btn-danger" href="{{action('LabAppointmentController@showLabReport',['id'=>Auth::user()->id,'labAppointment_id'=>$labAppointment->id])}}">Show Lab Report</a>

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
@endsection
{{--% endblock %--}}
