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
                    <td>{{$patient->name}}</td>
                </tr>
                <tr>
                    <th>Age</th>
                    <td>{{$patient->age}}</td>
                </tr>
                <tr>
                    <th>Gender</th>
                    <td>{{$patient->gender}}</td>
                </tr>
                <tr>
                    <th>E-mail</th>
                    <td>{{$patient->email}}</td>
                </tr>
                <tr>
                    <th>Contact Number</th>
                    <td>{{$patient->phone}}</td>
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
							<p>Condition: {{$docAppointment->prescription->condition}}</p>
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
