{{--% extends 'base.html' %--}}
@extends('layouts.app')

{{--% load static %--}}

{{--% block content %--}}
@section('content')
{{--% include 'partials/_header.html' %--}}
@extends('inc/_header.html')
<div class="docHeader">
    <h1>Dr. {{doctor->first_name}}  {{doctor->last_name}}'s Dashboard</h1>
</div>
<div class="mainContent docContent">
    {{--% include 'partials/_aside_doctor.html' %--}}
    @extends('inc/_aside_doctor.html')
    <article>
        <h2>Appointments</h2>
        <section class="cards upcoming-appointments">
            @if(docAppointments != null)
            {{--% if docAppointments != null %--}}

                @foreach($docAppointment as docAppointments)
                {{--% for docAppointment in docAppointments%--}}
                <div class="card appointment">
                    @foreach($patient as patients)
                    {{--% for patient in patients %--}}
                        @if($docAppointment->patient == patient->pk)
                        {{--% if docAppointment.patient == patient.pk %--}}
                            <h3>Patient's Name: {{patient->first_name}}  {{patient->last_name}}</h3>
                            <div class="appointment-content">
                                <div class="appointment-text">
                                    <p>Ailment Notes: {{docAppointment->notes}}</p>
                                    <span>Patient Age: {{patient->age}}</span>
                                    <span>Time and Date: {{docAppointment->time}}</span>
                                </div>
                                <div class="actionable">
                                    <button class="btn btn-danger">Show Patient Info</button>
                                </div>
                            </div>
                        @endif 
                        {{--% endif %--}}
                    @endforeach
                    {{--% endfor %--}}
                </div>
                @endforeach
                {{--% endfor %--}}
            @else
            {{--% else %--}}
                
                <p>No Upcoming Appointments</p>
            @endif 
            {{--% endif %--}}
            <a href="#" class="btn btn-danger addAppointment">Show Previous Appointments</a>
        </section>

        
    </article>
</div>
@endsection
{{--% endblock %--}}
