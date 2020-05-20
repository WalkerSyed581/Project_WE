@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-3 bg-dark" >
        <h1 class="text-center position-fixed" style="color:white">{{Auth::user()->name}}</h1>
        <aside class="col-md-3 p-0 flex-shrink-1 sticky-top" style="margin-top:30px">
            <!--fixed-top/sticky-top-->
            <nav class="navbar navbar-expand navbar-dark  flex-md-column flex-row align-items-start py-2">
                <div class="collapse navbar-collapse">
                    <ul class="flex-md-column flex-row navbar-nav w-100 justify-content-between ">
                        
                        <li class="nav-item">
                            <a class="nav-link pl-0" href=" #"><i class="fa fa-book fa-fw"></i> <span class="d-none d-md-inline">Lab Appointment</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-0" href=" #"><i class="fa fa-cog fa-fw"></i> <span class="d-none d-md-inline">Prescriptions</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-0" href=" #"><i class="fa fa-heart codeply fa-fw"></i> <span class="d-none d-md-inline">Appointments</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-0" href=" #"><i class="fa fa-heart codeply fa-fw"></i> <span class="d-none d-md-inline">Current Admission</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-0"href=" #"><i class="fa fa-heart codeply fa-fw"></i> <span class="d-none d-md-inline">All Admissions</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-0" href=" {{action('PatientController@showBill',['id'=>Auth::user()->id])}}"><i class="fa fa-heart codeply fa-fw"></i> <span class="d-none d-md-inline">Bills</span></a>
                        </li>
                        
                    </ul>
                </div>
            </nav>
        </aside>
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