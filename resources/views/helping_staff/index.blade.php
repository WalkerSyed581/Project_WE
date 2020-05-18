@extends('layouts.app')

@section('content')
<div class="docHeader">
    <h1>Mr. {{Auth::user()->name}}'s Dashboard</h1>
</div>
<div class="mainContent docContent">
    <article>
		@if($role == 'rc')
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
                <p>No Upcoming Doctor Appointments</p>
            @endif    
		</section>
		@elseif($role == 'ls')
			<h2>Upcoming Lab's Appointments</h2>
			<section class="cards upcoming-appointments">
				@if($labAppointments)
					@foreach($labAppointments as $labAppointment)
					<div class="card appointment">
						<div class="appointment-content">
							<div class="appointment-text">
								<p>Time and Date: {{$labAppointment->time}}</p>
								<p>Test: {{$labAppointment->labTest->name}}</p>
							</div>
							<div class="actionable">
								<a class="btn btn-danger" href="{{action('HelpingStaffController@showLabAppointment',['id'=>\Auth::user()->helpingStaff->id,'labAppointment_id'=>$labAppointment->id])}}">
									@if($labAppointment->approved)
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
					<p>No Upcoming Lab Appointments</p>
				@endif
			</section>
			<h2>Previous Lab Appointments</h2>
			<section class="cards upcoming-appointments">
				@if($prevLabAppointments)
					@foreach($prevLabAppointments as $labAppointment)
					<div class="card appointment">
						<div class="appointment-content">
							<div class="appointment-text">
								<p>Time and Date: {{$labAppointment->time}}</p>
								<p>Test: {{$labAppointment->labTest->name}}</p>
							</div>
							<div class="actionable">
								<a class="btn btn-danger" href="{{action('HelpingStaffController@addLabReport',['id'=>\Auth::user()->helpingStaff->id,'labAppointment_id'=>$labAppointment->id])}}">Add Lab Report</a>
							</div>
						</div>
					</div>
					@endforeach
				@else
					<p>No Previous Lab Appointments</p>
				@endif
			</section>
		@elseif($role == 'ws')
			<h2>Current Ward Duties</h2>
			<section class="cards upcoming-appointments">
				@if($duties)
					@foreach($duties as $duty)
					<div class="card appointment">
						<div class="appointment-content">
							<div class="appointment-text">
								<p>Patient: {{$duty->patient->user->name}}</p>
								<p>Patient Age: {{$duty->patient->user->age}}</p>
								<p>Start Date: {{$duty->from_date}}</p>
								<p>Number of Days: {{$duty->number_of_days}}</p>
								<p>Ward ID : {{$duty->ward->id}}</p>
							</div>
						</div>
					</div>
					@endforeach
				@else
					<p>No Upcoming Ward Duties</p>
				@endif
			</section>
		@endif

    </article>
</div>
@endsection
{{--% endblock %--}}
