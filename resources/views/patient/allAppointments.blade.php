@extends('layouts.app')
@section('content')
<div>
    
<div class="patientHeader col-md-12 ">
    <div class="row ">
        <div class="col-md-3 bg-dark" >
            <h1 class="text-center sticky-top" style="color:white">{{Auth::user()->name}}</h1>
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
<hr>
<div class="mainContent patientContent col-md-9">
    <article>
        
        <div class="col-md-12">
            <a  href=" {{action('PatientController@showBill',['id'=>\Auth::user()->patient->id])}}" class="btn btn-primary">Show Bill</a>
        </div>
        <hr>

        <div class="cards upcoming-appointments  col-md-12">
            <h2>Upcoming Doctor's Appointments</h2>
            @if($docAppointments)
            <table class="table">
                <tr>
                    <th>Doctor's Name</th>
                    <th>Doctor's Experise</th>
                    <th>Ailment Notes</th>
                    <th>Time and Date</th>
                    <th>Cancel</th>
                </tr>
                @foreach( $docAppointments as $docAppointment)
                <tr>
                    <td>{{$docAppointment->doctor->user->name}}</td>
                    <td>{{$docAppointment->doctor->specialization}}</td>
                    <td>{{$docAppointment->doctor->specialization}}</td>
                    <td>{{$docAppointment->time}}</td>
                    <td><a class="btn btn-primary" href="{{action('DoctorAppointmentController@destroy',['id'=>$docAppointment->id])}}">Cancel</a></td>
                </tr>
            
               
                @endforeach
                </table>
            @else
                <p>No Upcoming Appointments</p>
                
            @endif 
            <a href="{{action('PatientController@showAppointmentForm',['id'=>Auth::user()->id])}}" class="btn btn-primary addAppointment">Add New Appointment</a>
            </div>
        
        <hr>
        
        <div class="cards upcoming-appointments col-md-12">
            <h2>Upcoming Lab's Appointments</h2>
            @if($labAppointments)
            <table class="table">
                <tr>
                    <th>Conductor's Name</th>
                    <th>Time and Date</th>
                    <th>Cancel</th>
                </tr>
                @foreach($labAppointments as $labAppointment)
                <tr>
                    <td>{{$labAppointment->helpingStaff->user->name}}</td>
                    <td>{{$labAppointment->time}}</td>
                  
                    <td><a class="btn btn-primary" href="{{action('LabAppointmentController@destroy',['id'=>$labAppointment->id])}}">Cancel</a></td>
               
                </tr>
            
               
                @endforeach
                </table>
            @else
                <p>No Upcoming Lab Appointments</p>
            @endif
            </div>      
    </article>
</div>
</div>
</div>
</div>
@endsection
