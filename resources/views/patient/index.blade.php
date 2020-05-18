@extends('layouts.app')
@section('content')
<div class="patientPage">
<div class="patientHeader">
    <h1>Mr. {{Auth::user()->name}}'s Dashboard</h1>
</div>

<div class="mainContent patientContent">
    <article>
        <a  href=" {{action('PatientController@showBill',['id'=>Auth::user()->patient->id])}}" class="btn btn-danger">Show Bill</a>

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
									<a class="btn btn-danger" href="{{action('DoctorAppointmentController@destroy',['id'=> $docAppointment->id])}}">Cancel</a>
									<a class="btn btn-danger" href="{{action('PatientController@showPrescription',['id'=> Auth::user()->id,'appointment_id'=> $docAppointment->id])}}">View Prescription</a>
                                </div>
                            </div>
                </div>
                @endforeach
            @else
                <p>No Upcoming Appointments</p>
                
            @endif 
            <a href="{{action('PatientController@showAppointmentForm',['id'=>Auth::user()->id])}}" class="btn btn-danger addAppointment">Add New Appointment</a>
            <a href="{{action('PatientController@appoinmentArchive',['id'=>Auth::user()->id])}}" class="btn btn-danger appointmentArchive">Show Previous Appointments</a>
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

        <h2>Support Groups</h2>
        <section class="cards upcoming-appointments">
            @if($supportGroups)
            @foreach($supportGroups as $supportGroup)
                <div class="card appointment">
                            <h3>Support Group: {{$supportGroup->name}}</h3>
                            <div class="appointment-content">
                                <div class="appointment-text">
									<p>Conductor's Name: {{$supportGroup->supportGroupConductor->user->name}}</p>
									<p>Day: {{$supportGroup->day}}</p>
                                    <span>Time and Date: {{$supportGroup->timing}}</span>
                                    <p>Description: {{$supportGroup->description}}</p>
                                </div>
                                <div class="actionable">
                                    <a class="btn btn-danger" href="{{action('PatientController@leaveSupportGroup',['supportGroup_id'=>$supportGroup->id,'id'=>\Auth::user()->patient->id])}}">Leave</a>
                                </div>
                            </div>
                </div>
                @endforeach
            @else
                <p>You have not enrolled in any Support Group</p>
            @endif
            <a href="{{action('PatientController@showSupportGroups',['id'=>Auth::user()->id])}}" class="btn btn-danger addAppointment">Join Support Group</a>
        </section>
    </article>
</div>
</div>

@endsection
