@extends('layouts.app')

@section('content')


<main class="loginPage">
    <div class="row">
        <div class="col-md-3 bg-dark" >
            <h1 class="text-center position-fixed" style="color:white">Mr. {{Auth::user()->name}}</h1>
            @include('patient.aside')
        </div> 
        <div class="col-md-9" >
            <h2>Support Groups</h2>
    @if ($supportGroups)
    <table class='table'>
        <tr>
            <th scope="col">Support Group Title</th>
            <th scope="col">Conductor</th>
            <th scope="col">Time</th>
            <th scope="col">Day</th>
            <th scope="col">Fee</th>
            <th scope="col">Description</th>
            <th scope="col">Join Support Group</th>
        </tr>
        @foreach($supportGroups as $supportGroup)
        <tr>
            <td>{{$supportGroup->name}}</td>
            <td>{{$supportGroup->supportGroupConductor->user->name}}</td>
            <td> {{$supportGroup->timing}}</td>
            <td>{{$supportGroup->day}}</td>
            <td>{{$supportGroup->fee}}</td>
            <td>{{$supportGroup->description}}</td>
            <td> <a href="{{action('PatientController@joinSupportGroup',['id'=>\Auth::user()->id,'supportGroup_id' => $supportGroup->id])}}" class="btn btn-primary">Join Support Group</a></td>
            
        </tr>

        
        @endforeach
    </table>
        </div>
    @else
        <p>No Support Groups are currently on going</p>
    @endif

</main>
@endsection