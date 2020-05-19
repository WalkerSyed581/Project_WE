@extends('layouts.app')
@section('content')
<div class="docHeader">
    <h1>{{\Auth::user()->name}}'s Dashboard</h1>
</div>

<div class="mainContent docContent">
    <article>
        <section class="patient-personal-info">
            <table>
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
            @foreach ($docAppointment as docAppointments)
                <div class="card appointment">
                    <div class="appointment-content">
                        <div class="appointment-text">
                            <p>Ailment Notes: {{$docAppointment->notes}}</p>
							<span>Time and Date: {{$docAppointment->time}}</span>
							@if($docAppointment->prescription)
								<p>Condition: {{$docAppointment->prescription->condition}}</p>
								@foreach($docAppointment->prescription->drugs()->get() as $drug)
								<div>
									<p>Drug Name: {{$drug->name}}</p>
									<p>Drug Dose: {{$drug->dose}}</p>
								</div>
								@endforeach
							@endif
                        </div>
                    </div>
                </div>
                @endforeach
            @else                    
                <p>No Previous Appointments found for this patient</p>
            @endif
        </section>
    </article>
</div>
@endsection
