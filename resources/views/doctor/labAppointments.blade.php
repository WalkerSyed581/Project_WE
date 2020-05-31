@extends('layouts.app')
@section('content')
<div class="patientPage container-fluid col-md-12">
    <div class="row">
    @include('inc.aside')


<div class="mainContent patientContent col-md-9">
    <article>
		@if(\Auth::user()->patient)
			<a  href="{{action('PatientController@showBill',['id'=>\Auth::user()->patient->id])}}" class="btn btn-danger">Show Bill</a>
		@endif
		 <h2>Lab's Appointments for Prescription</h2>
        <section class="cards upcoming-appointments">
			@if(!$labAppointments->isEmpty())
			<div class="table-responsive">
            <table class="table">
                <tr>
                    <th>Conductor's Name</th>
                    <th>Time and Date</th>
                    <th>Test</th>
                    <th>Lab Report</th>
                </tr>
                @foreach($labAppointments as $labAppointment)
                <tr>
                    <td>{{$labAppointment->helpingStaff->user->name}}</td>
                    <td>{{$labAppointment->time}}</td>
                    <td>{{$labAppointment->labTest->name}}</td>
                    <td>
					@if(\Auth::user()->patient)
                        <a class="btn btn-primary" href="{{action('PatientController@showLabReport',['id'=>\Auth::user()->patient->id,'appointment_id'=>$labAppointment->id])}}">Show Lab Report</a>
                    @elseif(\Auth::user()->doctor)
                        <a class="btn btn-primary" href="{{action('DoctorController@showLabReport',['id'=>\Auth::user()->doctor->id,'prescription_id'=>$prescription_id,'appointment_id'=>$labAppointment->id])}}">Show Lab Report</a>
					@endif
					</td>
				</tr>
				@endforeach
            </table>
			</div>
            @else
                <p>No Lab Appointments Found for this Prescription</p>
            @endif
        </section>      
    </article>
</div>
</div>
</div>

@endsection
