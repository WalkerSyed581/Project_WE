{{--% extends 'base.html' %--}}
@extends('layouts.app')
{{--% load static %--}}

@section('contetn')
{{--% block content %--}}
<main class="loginPage">
    @extends('inc/_header.html')
    {{--% include 'partials/_header.html' %--}}
    @if ($supportGroups)
    {{--% if supportGroups %--}}
        @foreach($supportGroup as supportGroups)
        {{--% for supportGroup in supportGroups %--}}
        <div class="card appointment">
            <h3>Support Group Title: {{supportGroup->name}}</h3>
            @foreach ($conductor as supportGroupConductors)
            {{--% for conductor in supportGroupConductors %--}}
                @if ($supportGroup->conducted_by->id == conductor->id)
                {{--% if supportGroup.conducted_by.id == conductor.id %--}}
                   <h4>Conductor: {{conductor->first_name}}  {{conductor->last_name}}</h4>
                @endif
                   {{--% endif %--}}
            @endforeach
            {{--% endfor %--}}
            <div class="appointment-content">
                <div class="appointment-text">
                    <span>Time: {{supportGroup->timing}}</span>
                    <span>Day: {{supportGroup->day}}</span>
                    <span>Fee: {{supportGroup->fee}}</span>
                   
                    <p>Description: {{supportGroup->description}}</p>
                </div>
                <div class="actionable">
                    <a href="{% url 'patient:joinGroup' patient->id supportGroup->id %}" class="btn btn-danger">Join Support Group</a>
                </div>
            </div>
            
        </div>
        @endforeach
        {{--% endfor %--}}
    @else
    {{--% else %--}}
        <p>No Support Groups are currently on going</p>
    @endif
    {{--% endif %--}}

</main>
@endsection
{{--% endblock %--}}