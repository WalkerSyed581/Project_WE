@extends('layouts.app')
@section('content')
<div class="patientPage container-fluid ">
<div class="row">
	@include('inc.aside')

    <div class="col-md-9 pr-0">
	@if($type == 'cur')
		<h2>Current Admission</h2>
	@else
		<h2>Previous Admissions</h2>
	@endif
<section class="col-md-12">
	@if(!$admissions->isEmpty())
	<div class="table-responsive">

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
		</div>
		
	@else
		<p>No Admission Found</p>
	@endif
</section>
</div>
</div>
@endsection