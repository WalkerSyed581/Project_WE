@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-3 bg-dark" >
        <h1 class="text-center position-fixed" style="color:white">Mr. {{Auth::user()->name}}</h1>
        @include('patient.aside')
    </div> 
    <div class="col-md-9 " >
<h2>Current Admission</h2>
<section class="cards upcoming-appointments col-md-12">
    @if($admissions)
    <table class='table'>
        <tr>
            <th>Staff Member</th>
            <th>Start Date</th>
            <th>Number of Days</th>
        </tr>
        @foreach($admissions as $admission)
        <tr>
            <td>{{$admission->helpingStaff->user->name}}</td>
            <td> {{$admission->from_date}}</td>
            <td>{{$admission->number_of_days}}</td>
        </tr>
			
        @endforeach
        <table>
	@else
		<p>No Admission Found</p>
	@endif
</section>
</div>
@endsection