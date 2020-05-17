@extends('layouts.app')

@section('content')
<main class="loginPage">
    @if ($supportGroups)
        @foreach($supportGroups as $supportGroup)
        <div class="card appointment">
            <h3>Support Group Title: {{$supportGroup->name}}</h3>
            <h4>Conductor: {{$supportGroup->supportGroupConductor->user->name}}</h4>
            <div class="appointment-content">
                <div class="appointment-text">
                    <span>Time: {{$supportGroup->timing}}</span>
                    <span>Day: {{$supportGroup->day}}</span>
                    <span>Fee: {{$supportGroup->fee}}</span>
                   
                    <p>Description: {{$supportGroup->description}}</p>
                </div>
                <div class="actionable">
                    <a href="{{action('PatientController@joinSupportGroup',['id'=>\Auth::user()->id,'supportGroup_id' => $supportGroup->id])}}" class="btn btn-danger">Join Support Group</a>
                </div>
            </div>
        </div>
        @endforeach
    @else
        <p>No Support Groups are currently on going</p>
    @endif

</main>
@endsection