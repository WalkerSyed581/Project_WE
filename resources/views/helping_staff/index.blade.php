@extends('layouts.app')

@section('content')
<div class="container-fluid ">
    <div class="row">
    <div class="docHeader col-md-3 bg-dark" >
        <h1 class="text-center " style="color:white">{{Auth::user()->name}}</h1>
        <aside class="col-md-3 p-0 flex-shrink-1 sticky-top" style="margin-top:30px">
            <!--fixed-top/sticky-top-->
            <nav class="navbar navbar-expand navbar-dark  flex-md-column flex-row align-items-start py-2">
                <div class="collapse navbar-collapse">
                    <ul class="flex-md-column flex-row navbar-nav w-100 justify-content-between ">
                        
                        <li class="nav-item">
                            <a class="nav-link pl-0" href=" /Project_WE/public/helpingStaff/addLabReport"><i class="fa fa-book fa-fw"></i> <span class="d-none d-md-inline"></span>Add Lab Report</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-0" href="/Project_WE/public/helpingStaff/{id}/addTest"><i class="fa fa-cog fa-fw"></i> <span class="d-none d-md-inline">Add Lab Test</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-0" href=" /Project_WE/public/helpingStaff/{id}/labAppointment/{labAppointment_id}"><i class="fa fa-heart codeply fa-fw"></i> <span class="d-none d-md-inline">Show Lab Appointment</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-0" href=" /Project_WE/public/helpingStaff/{id}/addWard"><i class="fa fa-heart codeply fa-fw"></i> <span class="d-none d-md-inline">Add Ward</span></a>
                        </li>
                       
                        
                    </ul>
                </div>
            </nav>
        </aside>
    </div> 

<div class="mainContent docContent col-md-9">
    <article>
		@if($role == 'rc')
        <h2>Upcoming Appointments</h2>
        <section class="upcoming-appointments">
            @if(!$docAppointments->isEmpty())
            <table class='table'>
                <tr>
                    <th>Patient's Name</th>
                    <th>Patient's Age</th>
                    <th>Ailment Notes</th>
                    <th>Time and Date</th>
                    <th>Cancel/Approve</th>
                </tr>
                @foreach( $docAppointments as $docAppointment)
                
                <div class="appointment">
                    <tr>
                        <td>{{$docAppointment->patient->user->name}}</td>
                        <td>{{$docAppointment->patient->user->age}}</td>
                        <td> {{$docAppointment->notes}}</td>
                        <td>{{$docAppointment->time}}</td>
                        <td><a class="btn btn-primary" href="{{action('DoctorController@showAppointment',['id'=>\Auth::user()->doctor->id,'appointment_id'=> $docAppointment->id])}}">
                            @if($docAppointment->approved)
                                Cancel
                            @else
                                Approve
                            @endif
                        </a></td>
                    </tr>
                    
                          
                </div>
                @endforeach
                </table>
			@else
                <p>No Upcoming Doctor Appointments</p>
            @endif    
        </section>
        
		@elseif($role == 'ls')
			<h2>Upcoming Lab's Appointments</h2>
			<section class="upcoming-appointments">
                @if(!$labAppointments->isEmpty())
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
                            </table>
						
					@endforeach
				@else
					<p>No Upcoming Lab Appointments</p>
                @endif
                
			</section>
			<h2>Previous Lab Appointments</h2>
			<section class="upcoming-appointments">
                @if(!$prevLabAppointments->isEmpty())
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
                            </table>
								
						
							
					
					@endforeach
				@else
					<p>No Previous Lab Appointments</p>
				@endif
			</section>
			<h2>Lab Tests</h2>
			<section class="upcoming-appointments">
                @if(!$tests->isEmpty())
                <table class="table">
                <tr>
                    <th>Test Name</th>
                    <th>Test Description</th>
                    <th>Test Fee</th>
                    <th>Edit Test</th>
                    <th>Patient Profile</th>
                </tr>
                
                    @foreach($tests as $test)
                    <tr>
                        <td> {{$test->name}}</td>
                        <td>{{$test->descsription}}</td>
                        <td> {{$test->fee}}</td>
                        <td><a class="btn btn-primary" href="{{action('HelpingStaffController@showTest',['id'=>\Auth::user()->helpingStaff->id,'test_id'=>$test->id])}}">Edit Test</a></td>
                        <td><a class="btn btn-primary" href="{{action('DoctorController@patientInfo',['id'=> Auth::user()->id,'patient_id'=> $duty->patient->id])}}">View Patient Profile</a></td>
                    </tr>
                </table>
					
					@endforeach
				@else
					<p>No Tests Found</p>
				@endif
				<a class="btn btn-primary" href="{{action('HelpingStaffController@showTestForm',['id'=>\Auth::user()->helpingStaff->id])}}">Add Test</a>
			</section>
		@elseif($role == 'ws')
			<h2>Current Ward Duties</h2>
			<section class="upcoming-appointments">
                @if(!$duties->isEmpty())
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
				@else
					<p>No Upcoming Ward Duties</p>
				@endif
			</section>
			<h2>Wards</h2>
			<section class="upcoming-appointments">
                @if(!$wards->isEmpty())
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
				@else
					<p>No Wards Found</p>
				@endif
				<a class="btn btn-primary" href="{{action('HelpingStaffController@showWardForm',['id'=>\Auth::user()->helpingStaff->id])}}">Add Ward</a>
			</section>
		@endif

    </article>
</div>
@endsection

