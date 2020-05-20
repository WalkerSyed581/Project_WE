@extends('layouts.app')
@section('content')
<div class="container-fluid col-md-12">
    <div class="row">
    <div class="docHeader col-md-3 bg-dark" >
        <h1 class="text-center " style="color:white">{{Auth::user()->name}}</h1>
        <aside class="col-md-3 p-0 flex-shrink-1 sticky-top" style="margin-top:30px">
            <nav class="navbar navbar-expand navbar-dark  flex-md-column flex-row align-items-start py-2">
                <div class="collapse navbar-collapse">
                    <ul class="flex-md-column flex-row navbar-nav w-100 justify-content-between ">
                        
                        <li class="nav-item">
                            <a class="nav-link pl-0" href=" /Project_WE/public/doctor/addPrescription"><i class="fa fa-book fa-fw"></i> <span class="d-none d-md-inline">Add Prescription</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-0" href=" /Project_WE/public/doctor/addDrugs"><i class="fa fa-cog fa-fw"></i> <span class="d-none d-md-inline">Add Drugs</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-0" href=" /Project_WE/public/doctor/addLabAppointment"><i class="fa fa-heart codeply fa-fw"></i> <span class="d-none d-md-inline">Add Lab Appointment</span></a>
                        </li>
                                      
                    </ul>
                </div>
            </nav>
        </aside>
    </div> 

<div class="mainContent docContent col-md-9">
    <article class="content appointment-content">
        <section class="medical-report">
            <table class="table">
                <tr>
                    <th>Name</th>
                    <td>{{$patient->name}}</td>
                </tr>
                <tr>
                    <th>Age</th>
                    <td>{{$patient->age}}</td>
                </tr>
                <tr>
                    <th>Prescription Condition</th>
                    <td>{{$prescription->conditions}}</td>
                </tr>
                <tr>
                    <th>Prescription Notes</th>
                    <td>{{$prescription->notes}}</td>
				</tr>
				<tr>
                    <th>Test Conductor </th>
                    <td>{{$labAppointment->helpingStaff->user->name}}</td>
				</tr>
				<tr>
                    <th>Test Name </th>
                    <td>{{$labAppointment->test->name}}</td>
				</tr>
				@foreach($drugs as $drug)
					<tr>
						<th>{{$drug->name}}</th>
						<td>{{$drug->dose}}</td>
					</tr>
				@endforeach
			</table>
			<h2>Lab Report</h2>
            @if($labReport)
                <div class="card appointment">
					<div class="appointment-content">
						<div class="appointment-text">
							{{$labReport->}}
						</div>
					</div>
				</div>
            @else
                <p>No Lab Report found for this prescription</p>
            @endif
        </section>
    </article>
</div>
</div>
</div>
@endsection