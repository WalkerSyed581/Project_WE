@extends('layouts.app')

@section('content')
<div class="container-fluid col-md-12">
    <div class="row">
    <div class="docHeader col-md-3 bg-dark" >
        <h1 class="text-center " style="color:white">{{Auth::user()->name}}</h1>
        <aside class="col-md-3 p-0 flex-shrink-1 sticky-top" style="margin-top:30px">
            <!--fixed-top/sticky-top-->
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
        <h2>Upcoming Appointments</h2>
        <section class="cards upcoming-appointments">
            @if(!$docAppointments->isEmpty())
            <table class="table">
                <tr>
                    <th>Patient's Name</th>
                    <th>Patient's Age</th>
                    <th>Ailment Notes</th>
                    <th>Time and Date</th>
                    <th>Cancel/Approve</th>
                    <th>Patient Profile</th>
                </tr>
                @foreach( $docAppointments as $docAppointment)
                <tr>
                    <td> {{$docAppointment->patient->user->name}}</td>
                    <td> {{$docAppointment->patient->user->age}}</td>
                    <td>{{$docAppointment->notes}}</td>
                    <td> {{$docAppointment->time}}</td>
                    <td><a class="btn btn-primary" href="{{action('DoctorController@showAppointment',['id'=>\Auth::user()->doctor->id,'appointment_id'=> $docAppointment->id])}}">
                        @if($docAppointment->approved)
                            Cancel
                        @else
                            Approve
                        @endif
                    </a></td>
                    <td><a class="btn btn-primary" href="{{action('DoctorController@patientInfo',['id'=> Auth::user()->id,'patient_id'=> $docAppointment->patient->id])}}">View Patient Profile</a></td>
                </tr>
            
                              @endforeach
                              </table>
            @else
                <p>No Upcoming Appointments</p>
                
            @endif 
            <a href="{{action('DoctorController@addAppointment',['id'=>Auth::user()->doctor->id])}}" class="btn btn-primary addAppointment">Add New Appointment</a>
		</section>

        <hr>
		
		<h2>Previous Appointments</h2>
        <section class="cards upcoming-appointments">
            @if(!$prevDocAppointments->isEmpty())
            <table>
                <tr>
                    <th>Patient's Name</th>
                    <th>Patient's Age</th>
                    <th>Ailment Notes</th>
                    <th>Time and Date</th>
                    <th>View Prescription</th>
                    <th> Patient Profile</th>
                </tr>
                @foreach($prevDocAppointments as $docAppointment)
                <tr>
                    <td> {{$docAppointment->patient->user->name}}</td>
                    <td>{{$docAppointment->patient->user->age}}</td>
                    <td> {{$docAppointment->notes}}</td>
                    <td> {{$docAppointment->time}}</td>
                    <td><a class="btn btn-primary" href="{{action('DoctorController@viewPrescription',['id'=> Auth::user()->doctor->id,'appointment_id'=> $docAppointment->id])}}">View Prescription</a></td>
                    <td><a class="btn btn-primary" href="{{action('DoctorController@patientInfo',['id'=> Auth::user()->id,'patient_id'=> $docAppointment->patient->id])}}">View Patient Profile</a></td>
                </tr>
            </table>
                @endforeach
            @else
                <p>No Previous Appointments</p>
                
            @endif 
		</section>


    </article>
</div>
@endsection

