@extends('layouts.app')
{{--% extends 'base.html' %--}}

{{--% load static %--}}
@section('content')
@extends('inc/_header.html')
{{--% block content %--}}
{{--% include 'partials/_header.html' %--}}

<div class="docHeader">
    <h1>{{doctorName}}'s Dashboard</h1>
</div>

<div class="mainContent docContent">
    {{--% include 'partials/_aside_doctor.html' %--}}
    @extends('inc/_aside_doctor.html')
    <article>
        <section class="patient-personal-info">
            <table>
                <tr>
                    <th>Name</th>
                    <td>{{patient->first_name}}  {{patient->last_name}}</td>
                </tr>
                <tr>
                    <th>Age</th>
                    <td>{{patient->age}}</td>
                </tr>
                <tr>
                    <th>Gender</th>
                    <td>{{patient->gender}}</td>
                </tr>
                <tr>
                    <th>E-mail</th>
                    <td>{{patient->email}}</td>
                </tr>
                <tr>
                    <th>Contact Number</th>
                    <td>{{patient->phone}}</td>
                </tr>
            </table>
        </section>
        <section class="medical-report">
            @if($docAppointments != null)
            {{--% if docAppointments != null %--}}
            @foreach ($docAppointment as docAppointments)
                {{--% for docAppointment in docAppointments%--}}
                <div class="card appointment">
                    <h3>Patient's Name: {{patient->first_name}}  {{patient->last_name}}</h3>
                    <div class="appointment-content">
                        <div class="appointment-text">
                            <p>Ailment Notes: {{docAppointment->notes}}</p>
                            <span>Patient Age: {{patient->age}}</span>
                            <span>Time and Date: {{docAppointment->time}}</span>
                        </div>
                        <div class="actionable">
                            <button class="btn btn-danger">Show Report</button>
                        </div>
                    </div>
                </div>
                @endforeach
                {{--% endfor %--}}
            @else    
            {{--% else %--}}
                
                <p>No Previous Appointments found for this patient</p>

            @endif
            {{--% endif %--}}
        </section>
    </article>
</div>
@endsection
{{--% endblock %--}}