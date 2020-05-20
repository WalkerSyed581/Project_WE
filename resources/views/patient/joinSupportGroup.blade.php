@extends('layouts.app')

@section('content')


<main class="loginPage container-fluid">
    <div class="row">
		@include('inc.aside')

        <div class="col-md-9" >
            <h2>Support Groups</h2>
	@if (!$supportGroups->isEmpty())
	<div class="table-responsive">
    <table class='table'>
        <tr>
            <th scope="col">Support Group Title</th>
            <th scope="col">Conductor</th>
            <th scope="col">Time</th>
            <th scope="col">Day</th>
            <th scope="col">Fee</th>
			<th scope="col">Description</th>
			@if(\Auth::user()->role=='p')
			<th scope="col">Join Support Group</th>
			@elseif(\Auth::user()->role=='a')
			<th scope="col">Edit Support Group</th>
			<th scope="col">Remove Support Group</th>
			@endif
        </tr>
        @foreach($supportGroups as $supportGroup)
        <tr>
            <td>{{$supportGroup->name}}</td>
            <td>{{$supportGroup->supportGroupConductor->user->name}}</td>
            <td> {{$supportGroup->timing}}</td>
            <td>{{$supportGroup->day}}</td>
            <td>{{$supportGroup->fee}}</td>
            <td>{{$supportGroup->description}}</td>
             @if(\Auth::user()->role=='p')
                <td><a href="{{action('PatientController@joinSupportGroup',['id'=>\Auth::user()->patient->id,'supportGroup_id' => $supportGroup->id])}}" class="btn btn-primary">Join Support Group</a>        </td>

         @elseif(\Auth::user()->role=='a')
             <td><a href="{{action('SupportGroupController@edit',['id'=>\Auth::user()->id,'supportGroup_id' => $supportGroup->id])}}" class="btn btn-primary">Edit Support Group</a></td>
             <td><a href="{{action('SupportGroupController@destroy',['id'=>\Auth::user()->id,'supportGroup_id' => $supportGroup->id])}}" class="btn btn-primary">Remove Support Group</a></td>
         @endif
            
        </tr>

        
        @endforeach
	</table>
	</div>
    @else
        <p>No Support Groups are currently on going</p>
    @endif
	@if(\Auth::user()->role=='a')
	<a href="{{action('AdminController@showSupportGroupForm',['id'=>\Auth::id()])}}" class="btn btn-primary">Add Support Group</a>
	@endif
</div>

</main>
@endsection