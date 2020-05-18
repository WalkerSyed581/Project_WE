@extends('layouts.app')
@section('content')
<div class="patientPage">
    
<div class="patientHeader col-md-12 ">
    <div class="row ">
        <div class="col-md-3 bg-dark" >
            <h1 class="text-center sticky-top" style="color:white">Mr. {{Auth::user()->name}}</h1>
            @include('patient.aside')
       
        </div>
<hr>
<div class="mainContent patientContent col-md-9">
    <article>
        
        <div class="col-md-12">
        <a  href=" {{action('PatientController@showBill',['id'=>Auth::user()->id])}}" class="btn btn-primary">Show Bill</a>
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
                    <td><a class="btn btn-primary" href="{{action('DoctorAppointmentController@destroy',['id'=>$docAppointment->id])}}">Cancel</a</td>
                </tr>
            </table>
               
                @endforeach
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
            </table>
               
                @endforeach
            @else
                <p>No Upcoming Lab Appointments</p>
            @endif
            </div>      
    </article>
</div>
</div>
</div>

@endsection
