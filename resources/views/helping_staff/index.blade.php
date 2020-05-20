@extends('layouts.app')

@section('content')
<div class="container-fluid ">
    <div class="row">
    @include('inc.aside')

<div class="mainContent docContent col-md-9">
    <article>
		@if($role == 'rc')
        <h2>Upcoming Appointments</h2>
        <section class="upcoming-appointments">
			@if(!$docAppointments->isEmpty())
			<div class="table-responsive">
            <table class='table'>
                <tr>
                    <th>Patient's Name</th>
                    <th>Patient's Age</th>
                    <th>Ailment Notes</th>
                    <th>Time and Date</th>
                    <th>Cancel/Approve</th>
                </tr>
                @foreach( $docAppointments as $docAppointment)
                
                    <tr>
                        <td>{{$docAppointment->patient->user->name}}</td>
                        <td>{{$docAppointment->patient->user->age}}</td>
                        <td> {{$docAppointment->notes}}</td>
                        <td>{{$docAppointment->time}}</td>
                        <td><a class="btn btn-primary" href="{{action('DoctorController@showAppointment',['id'=>\Auth::user()->helpingStaff->id,'appointment_id'=> $docAppointment->id])}}">
                            @if($docAppointment->approved)
                                Cancel
                            @else
                                Approve
                            @endif
                        </a></td>
					</tr>
					@endforeach
			</table>
			</div>    
                
			@else
                <p>No Upcoming Doctor Appointments</p>
            @endif    
        </section>
        
		@elseif($role == 'ls')
			<h2>Upcoming Lab's Appointments</h2>
			<section class="upcoming-appointments">
				@if(!$labAppointments->isEmpty())
				<div class="table-responsive">
                <table class='table'>
                    <tr>
                        <th>Time and Date</th>
                        <th>Test</th>
                        <th>Add Lab Report</th>
                        <th>Patient Profile</th>
                    </tr>
					@foreach($labAppointments as $labAppointment)
				
                                <tr>
                                    <td>{{$labAppointment->time}}</td>
                                    <td>{{$labAppointment->labTest->name}}</td>
                                    <td><a class="btn btn-primary" href="{{action('HelpingStaffController@showLabAppointment',['id'=>\Auth::user()->helpingStaff->id,'labAppointment_id'=>$labAppointment->id])}}">
                                        @if($labAppointment->approved)
                                            Cancel
                                        @else
                                            Approve
                                        @endif
                                    </a></td>
                                    <td><a class="btn btn-primary" href="{{action('DoctorController@patientInfo',['id'=> Auth::user()->id,'patient_id'=> $labAppointment->patient->id])}}">View Patient Profile</a></td>
								</tr>
								@endforeach

				</table>
				</div>
				@else
					<p>No Upcoming Lab Appointments</p>
                @endif
                
			</section>
			<h2>Previous Lab Appointments</h2>
			<section class="upcoming-appointments">
				@if(!$prevLabAppointments->isEmpty())
				<div class="table-responsive">
                <table class='table'>
                    <tr>
                        <th>Time and Date</th>
                        <th>Test</th>
                        <th>Add Lab Report</th>
                        <th>Patient Profile</th>
                    </tr>
					@foreach($prevLabAppointments as $labAppointment)
					
							
                                <tr>
                                    <td>{{$labAppointment->time}}</td>
                                    <td>{{$labAppointment->labTest->name}}</td>
                                    <td><a class="btn btn-primary" href="{{action('HelpingStaffController@addLabReport',['id'=>\Auth::user()->helpingStaff->id,'labAppointment_id'=>$labAppointment->id])}}">Add Lab Report</a></td>
                                    <td><a class="btn btn-primary" href="{{action('DoctorController@patientInfo',['id'=> Auth::user()->id,'patient_id'=> $labAppointment->patient->id])}}">View Patient Profile</a></td>
								</tr>
					@endforeach

					</table>
				</div>
								
						
							
					
				@else
					<p>No Previous Lab Appointments</p>
				@endif
			</section>
			<h2>Lab Tests</h2>
			<section class="upcoming-appointments">
				@if(!$tests->isEmpty())
				<div class="table-responsive">
                <table class="table">
                <tr>
                    <th>Test Name</th>
                    <th>Test Description</th>
                    <th>Test Fee</th>
                    <th>Edit Test</th>
                </tr>
                
                    @foreach($tests as $test)
                    <tr>
                        <td> {{$test->name}}</td>
                        <td>{{$test->description}}</td>
                        <td> {{$test->fee}}</td>
                        <td><a class="btn btn-primary" href="{{action('HelpingStaffController@showTest',['id'=>\Auth::user()->helpingStaff->id,'test_id'=>$test->id])}}">Edit Test</a></td>
					</tr>
					@endforeach
                </table>
				</div>
				@else
					<p>No Tests Found</p>
				@endif
				<a class="btn btn-primary" href="{{action('HelpingStaffController@showTestForm',['id'=>\Auth::user()->helpingStaff->id])}}">Add Test</a>
			</section>
		@elseif($role == 'ws')
			<h2>Current Ward Duties</h2>
			<section class="upcoming-appointments">
				@if(!$duties->isEmpty())
				<div class="table-responsive">
                <table class= "table">
                    <tr>
                        <th>Patient</th>
                        <th>Patient Age</th>
                        <th>Start Date</th>
                        <th>Number of Days</th>
                        <th>Ward ID</th>
                    </tr>
                    @foreach($duties as $duty)
                    <tr>
                        <td>{{$duty->patient->user->name}}</td>
                        <td>{{$duty->patient->user->age}}</td>
                        <td>{{$duty->from_date}}</td>
                        <td>{{$duty->number_of_days}}</td>
                        <td>{{$duty->ward->id}}</td>
                    </tr>
					
					@endforeach
				</table>
				</div>
				@else
					<p>No Upcoming Ward Duties</p>
				@endif
			</section>
			<h2>Wards</h2>
			<section class="upcoming-appointments">
				@if(!$wards->isEmpty())
				<div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>Ward ID</th>
                        <th>Ward Capacity</th>
                        <th>Edit Ward</th>
                    </tr>
                    @foreach($wards as $ward)
                    <tr>
                        <td>{{$ward->id}}</td>
                        <td>{{$ward->capacity}}</td>
                        <td><a class="btn btn-primary" href="{{action('HelpingStaffController@showWard',['id'=>\Auth::user()->helpingStaff->id,'ward_id'=>$ward->id])}}">Edit Ward</a></td>
                    </tr>
					
					@endforeach
				</table>
				</div>
				@else
					<p>No Wards Found</p>
				@endif
				<a class="btn btn-primary" href="{{action('HelpingStaffController@showWardForm',['id'=>\Auth::user()->helpingStaff->id])}}">Add Ward</a>
			</section>
		@endif

    </article>
</div>
@endsection

