@extends('layouts.app')
@section('content')
<div class="patientPage billPage">
    <div class="patientHeader">
        <div class="row">
            <div class="col-md-3 bg-dark" >
                <h1 class="text-center " style="color:white">{{Auth::user()->name}}</h1>
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
    <div class="col-md-9" >
    <article class="content billContent">
		@if($fees)
			<p>Payment Method : Cash</p>
			<ul id="fees">
				<li class="doctor-fee">
					Total fee of all appointments: {{$fees['doctorFee']}} 
				</li>
				<li class="room-fee">
					Ward Fee: {{$fees['wardFee']}} 
				</li>
				<li>
					Total Fee of Support Groups: {{$fees['supportGroupFee']}}
				</li>
				<li class="dropright">
					<a href="#" class= "dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Total Fee of Lab Tests: {{$fees['totalTestFee']}}</a>
					<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
						@foreach($fees['testFees'] as $testFee)
							<li class="dropdown-item">{{$testFee['name']}} : {{$testFee['fee']}}</li>
						@endforeach
					</ul>
				</li>
				<li class="total-fee">
					Total: {{$fees['totalFee']}}
				</li>
			</ul>
		@else
			<p>No Bill found
		@endif
    </article>
</div>
</div>
</div>
</div>
@endsection