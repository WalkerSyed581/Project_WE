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
    <article>
        <section class="patient-personal-info">
            <table class= "table">
                <tr>
                    <th>Name</th>
                    <td>{{$patient->user->name}}</td>
                </tr>
                <tr>
                    <th>Age</th>
                    <td>{{$patient->user->age}}</td>
                </tr>
                <tr>
					<th>Gender</th>
					<td>
						@if($patient->user->gender == 'f')
						Female
						@else
						Male
						@endif
					</td>
                </tr>
                <tr>
                    <th>E-mail</th>
                    <td>{{$patient->user->email}}</td>
                </tr>
                <tr>
                    <th>Contact Number</th>
                    <td>{{$patient->user->phone}}</td>
				</tr>
				<tr>
                    <th>Emergencey Contact Number</th>
                    <td>{{$patient->emergencey_contact}}</td>
                </tr>
            </table>
        </section>
        <section class="medical-report">
			<h2>Patient's Doctor Appointments</h2>
            @if($docAppointments != null)
            <table class= "table">
                <tr>
                    <th>Ailment Notes</th>
                    <th>Time and Date</th>
                    <th>Condition</th>
                    <th>Drug Name</th>
                    <th>Drug Dose</th>
                </tr>
            @foreach ($docAppointment as docAppointments)
            <tr>
                <td>{{$docAppointment->notes}}</td>
                <td>{{$docAppointment->time}}</td>
                <td>@if($docAppointment->prescription)
                    <p>Condition: {{$docAppointment->prescription->condition}}</p></td>
                @foreach($docAppointment->prescription->drugs()->get() as $drug)
                <td>{{$drug->name}}</td>
                <td>{{$drug->dose}}</td>
                @endforeach
            </tr>
            
                @endforeach
                </table>
            @else                    
                <p>No Previous Appointments found for this patient</p>
            @endif
        </section>
    </article>
</div>
</div>
</div>
@endsection
