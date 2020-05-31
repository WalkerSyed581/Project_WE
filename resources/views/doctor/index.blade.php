@extends('layouts.app')

@section('content')
<div class="container-fluid col-md-12 h-100">
    <div class="row">
    @include('inc.aside')

<div class="mainContent docContent col-md-9">
    <article>
        <h2>Upcoming Appointments</h2>
        <section class="cards upcoming-appointments">
			@if(!$docAppointments->isEmpty())
			<div class="table-responsive">
            <table class="table">
                <tr>
                    <th>Patient's Name</th>
                    <th>Patient's Age</th>
                    <th>Ailment Notes</th>
                    <th>Time and Date</th>
                    <th>Cancel/Approve</th>
                    <th>Patient Profile</th>
                </tr>
                @foreach( $docAppointments as $docAppointment)
                <tr>
                    <td> {{$docAppointment->patient->user->name}}</td>
                    <td> {{$docAppointment->patient->user->age}}</td>
                    <td>{{$docAppointment->notes}}</td>
                    <td> {{$docAppointment->time}}</td>
                    <td><a class="btn btn-primary" href="{{action('DoctorController@showAppointment',['id'=> \Auth::user()->doctor->id,'appointment_id'=> $docAppointment->id])}}">
                        @if($docAppointment->approved)
                            Cancel
                        @else
                            Approve
                        @endif
                    </a></td>
                    <td><a class="btn btn-primary" href="{{action('DoctorController@patientInfo',['id'=> Auth::user()->id,'patient_id'=> $docAppointment->patient->id])}}">View Patient Profile</a></td>
				</tr>
				@endforeach
			</table>
			</div>
            @else
                <p>No Upcoming Appointments</p>
                
            @endif 
            <a href="{{action('DoctorController@addAppointment',['id'=>Auth::user()->doctor->id])}}" class="btn btn-primary addAppointment">Add New Appointment</a>
		</section>

        <hr>
		
		<h2>Previous Appointments</h2>
        <section class="cards upcoming-appointments">
			@if(!$prevDocAppointments->isEmpty())
			<div class="table-responsive">
            <table class="table">
                <tr>
                    <th>Patient's Name</th>
                    <th>Patient's Age</th>
                    <th>Ailment Notes</th>
                    <th>Time and Date</th>
                    <th>View Prescription</th>
                    <th> Patient Profile</th>
                </tr>
                @foreach($prevDocAppointments as $docAppointment)
                <tr>
                    <td> {{$docAppointment->patient->user->name}}</td>
                    <td>{{$docAppointment->patient->user->age}}</td>
                    <td> {{$docAppointment->notes}}</td>
                    <td> {{$docAppointment->time}}</td>
                    <td><a class="btn btn-primary" href="{{action('DoctorController@viewPrescription',['id'=> Auth::user()->doctor->id,'appointment_id'=> $docAppointment->id])}}">View Prescription</a></td>
                    <td><a class="btn btn-primary" href="{{action('DoctorController@patientInfo',['id'=> Auth::user()->id,'patient_id'=> $docAppointment->patient->id])}}">View Patient Profile</a></td>
				</tr>
				@endforeach
			</table>
			</div>
            @else
                <p>No Previous Appointments</p>
            @endif 
		</section>


    </article>
</div>
@endsection

