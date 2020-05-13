{{--% extends 'base.html' %--}}
@extends('layouts.app')
@section('content')
{{--% block content %--}}
<div class="docHeader">
    <h1>{{doctorName}}'s Dashboard</h1>
</div>
<div class="mainContent docContent">
    @extends('partials/_aside_doctor.html')
    {{--% include 'inc/_aside_doctor.html' %--}}
    <article class="content appointment-content">

        <section class="medical-report">
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
                    <th>Prescription Condition</th>
                    <td>{{prescription->conditions}}</td>
                </tr>
                <tr>
                    <th>Prescription Notes</th>
                    <td>{{prescription->notes}}</td>
                </tr>
            </table>
            @if( $labAppointments != null)
            {{--% if labAppointments != null %--}}
                @foreach ($labAppointment as $labAppointments)

                {{--% for labAppointment in labAppointments %--}}
                    @foreach ($test as tests)
                    {{--% for test in tests %--}}
                        @if( $labAppointment->test_id == test->id)
                        {{--% if labAppointment.test_id == test.id %--}}
                            <div class="card appointment">
                                <h3>Test Name: {{test->first_name}}</h3>
                                <div class="appointment-content">
                                    <div class="appointment-text">
                                        {% set conductor = conductors.get(pk=labAppointment.conducted_by) %--}}
                                        <p>Conducted By: {{conductor->first_name}}  {{conductor->last_name}}</p>
                                        <p>Conductor's Contact: {{conductor->phone}}</p>
                                        <span>Appointment Notes: {{labAppointment->notes}}</span>
                                        <span>Time and Date: {{labAppointment->time}}</span>
                                    </div>
                                    <div class="actionable">
                                        {{--% set labReport = labReports.get(appointment = labAppointment.id) %--}}
                                        <a class="btn btn-danger" href="{% url 'patient:labReport' patient.id labReport.id %}">Show Report</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        {{--% endif %--}}
                    @endforeach
                    {{--% endfor %--}}
                    @endforeach
                {{--% endfor %--}}
            @else
            {{--% else %--}}
                
                <p>No Previous Lab Reports found for this patient</p>
            @endif
            {{--% endif %--}}
        </section>

    </article>

</div>
@endsection
{{--% endblock %--}}