@extends('layouts.app')
@section('content')
<div class="container-fluid col-md-12">
    <div class="row">
	@include('inc.aside')


<div class="mainContent docContent col-md-9">
    <article>
		<h2>Patient's Profile</h2>
        <section class="patient-personal-info">
            <table class= "table">
                <tr>
                    <th>Name</th>
                    <td>{{$patient->user->name}}</td>
                </tr>
                <tr>
                    <th>Age</th>
                    <td>{{$patient->user->age}}</td>
                </tr>
                <tr>
					<th>Gender</th>
					<td>
						@if($patient->user->gender == 'f')
						Female
						@else
						Male
						@endif
					</td>
                </tr>
                <tr>
                    <th>E-mail</th>
                    <td>{{$patient->user->email}}</td>
                </tr>
                <tr>
                    <th>Contact Number</th>
                    <td>{{$patient->user->phone}}</td>
				</tr>
				<tr>
                    <th>Emergencey Contact Number</th>
                    <td>{{$patient->emergencey_contact}}</td>
                </tr>
            </table>
        </section>
        <section class="medical-report">
			<h2>Patient's Doctor Appointments</h2>
			@if($docAppointments != null)
			<div class="table-reponsive">
            <table class= "table">
                <tr>
                    <th scope="col">Ailment Notes</th>
                    <th scope="col">Time and Date</th>
					<th scope="col">Condition</th>
					<th scope="col">Drug Names</th>
					<th scope="col">Drug Dose</td>
                </tr>
            @foreach ($docAppointments as $docAppointment)
            <tr>
                <td>{{$docAppointment->notes}}</td>
                <td>{{$docAppointment->time}}</td>
                @if($docAppointment->prescription)
						<td><p>{{$docAppointment->prescription->condition}}</p></td>
						<td>
							<ul>
							@foreach($docAppointment->prescription->drugs()->get() as $drug)<li>{{$drug->name}}</li>@endforeach
							</ul>
						</td>
						<td>
							<ul>
							@foreach($docAppointment->prescription->drugs()->get() as $drug)
								<li>{{$drug->dose}}</li>
							@endforeach
							</ul>
						</td>
					@endif
			</tr>
			@endforeach
			</table>
			</div>
            @else                    
                <p>No Previous Appointments found for this patient</p>
            @endif
        </section>
    </article>
</div>
</div>
</div>
@endsection
