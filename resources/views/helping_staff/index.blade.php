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
				@if(!$labAppointments->isEmpty())
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
								<a class="btn btn-danger" href="{{action('DoctorController@patientInfo',['id'=> Auth::user()->id,'patient_id'=> $labAppointment->patient->id])}}">View Patient Profile</a>
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
				@if(!$prevLabAppointments->isEmpty())
					@foreach($prevLabAppointments as $labAppointment)
					<div class="card appointment">
						<div class="appointment-content">
							<div class="appointment-text">
								<p>Time and Date: {{$labAppointment->time}}</p>
								<p>Test: {{$labAppointment->labTest->name}}</p>
							</div>
							<div class="actionable">
								<a class="btn btn-danger" href="{{action('HelpingStaffController@addLabReport',['id'=>\Auth::user()->helpingStaff->id,'labAppointment_id'=>$labAppointment->id])}}">Add Lab Report</a>
								<a class="btn btn-danger" href="{{action('DoctorController@patientInfo',['id'=> Auth::user()->id,'patient_id'=> $labAppointment->patient->id])}}">View Patient Profile</a>
							</div>
						</div>
					</div>
					@endforeach
				@else
					<p>No Previous Lab Appointments</p>
				@endif
			</section>
			<h2>Lab Tests</h2>
			<section class="cards upcoming-appointments">
				@if(!$tests->isEmpty())
					@foreach($tests as $test)
					<div class="card appointment">
						<div class="appointment-content">
							<div class="appointment-text">
								<p>Test Name: {{$test->name}}</p>
								<p>Test Description: {{$test->descsription}}</p>
								<p>Test Fee: {{$test->fee}}</p>
							</div>
							<div class="actionable">
								<a class="btn btn-danger" href="{{action('HelpingStaffController@showTest',['id'=>\Auth::user()->helpingStaff->id,'test_id'=>$test->id])}}">Edit Test</a>
							</div>
						</div>
					</div>
					@endforeach
				@else
					<p>No Tests Found</p>
				@endif
				<a class="btn btn-danger" href="{{action('HelpingStaffController@showTestForm',['id'=>\Auth::user()->helpingStaff->id])}}">Add Test</a>
			</section>
		@elseif($role == 'ws')
			<h2>Current Ward Duties</h2>
			<section class="cards upcoming-appointments">
				@if(!$duties->isEmpty())
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
							<div class="actionable">
								<a class="btn btn-danger" href="{{action('DoctorController@patientInfo',['id'=> Auth::user()->id,'patient_id'=> $duty->patient->id])}}">View Patient Profile</a>
							</div>
						</div>
					</div>
					@endforeach
				@else
					<p>No Upcoming Ward Duties</p>
				@endif
			</section>
			<h2>Wards</h2>
			<section class="cards upcoming-appointments">
				@if(!$wards->isEmpty())
					@foreach($wards as $ward)
					<div class="card appointment">
						<div class="appointment-content">
							<div class="appointment-text">
								<p>Ward ID: {{$ward->id}}</p>
								<p>Ward Capacity: {{$ward->capacity}}</p>
							</div>
							<div class="actionable">
								<a class="btn btn-danger" href="{{action('HelpingStaffController@showWard',['id'=>\Auth::user()->helpingStaff->id,'ward_id'=>$ward->id])}}">Edit Ward</a>
							</div>
						</div>
					</div>
					@endforeach
				@else
					<p>No Wards Found</p>
				@endif
				<a class="btn btn-danger" href="{{action('HelpingStaffController@showWardForm',['id'=>\Auth::user()->helpingStaff->id])}}">Add Ward</a>
			</section>
		@endif

    </article>
</div>
@endsection
{{--% endblock %--}}
