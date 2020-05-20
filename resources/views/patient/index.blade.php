@extends('layouts.app')
@section('content')

<div class="patientPage container-fluid ">
    <div class="patientHeader row">
    @include('inc.aside')

    <div class="mainContent patientContent patientHeader col-md-9">
   
     
       
        <main>
        <div  class='col-md-12'>
        <a  href=" {{action('PatientController@showBill',['id'=>Auth::user()->patient->id])}}" class="btn btn-primary">Show Bill</a>
        </div>

        <hr>
        
        <div class='col-md-12'>
        <h2 > Upcoming Doctor's Appointments</h2>
        <section class="upcoming-appointments">
            @if(!$docAppointments->isEmpty())
            <table class="table">
                <tr>
                <th scope="col">Doctor's Name:</th>
                <th scope="col">Doctor's Experise</th>
                <th scope="col">Ailment Notes</th>
                <th scope="col">Time and Date</th>
                <th scope="col">Edit</th>
                </tr>
            
                @foreach( $docAppointments as $docAppointment)
                <tr>
                    <td>{{$docAppointment->doctor->user->name}}</td>
                    <td>{{$docAppointment->doctor->specialization}}</td>
                    <td> {{$docAppointment->notes}}</td>
                    <td>{{$docAppointment->time}}</td>
                    <td><a class="btn btn-primary" href="{{action('DoctorAppointmentController@destroy',['appointment_id'=> $docAppointment->id])}}">Cancel</a></td>
                </tr>  
            </table>
                
                @endforeach
            @else
                <p>No Upcoming Appointments</p>
                
            @endif 
            <hr>
            <a class="btn btn-primary" href="{{action('PatientController@showAppointmentForm',['id'=>Auth::user()->patient->id])}}" class="btn btn-danger addAppointment">Add New Appointment</a>
            <a class="btn btn-primary" href="{{action('PatientController@appoinmentArchive',['id'=>Auth::user()->patient->id])}}" class="btn btn-danger appointmentArchive">Show Previous Appointments</a>
		</section>
        </div>
        
        <hr>

        <div class="col-md-12">
        <h2> Upcoming Lab's Appointments</h2>
        <section class=" upcoming-appointments">
            @if(!$labAppointments->isEmpty())
            <table class="table">
                <tr>
                <th scope="col">Conductor's Name</th>
                <th scope="col">Time and Date:</th>
                <th scope="col">Test</th>
                <th scope="col">Cancel</th>
                </tr>    
            @foreach($labAppointments as $labAppointment)
            <tr>
            <td> {{$labAppointment->helpingStaff->user->name}}</td>
            <td>{{$labAppointment->time}}</td>
            <td>{{$labAppointment->labTest->name}}</td>
            <td><a class="btn btn-primary" href="{{action('LabAppointmentController@destroy',['appointment_id'=>$labAppointment->id])}}">Cancel</a></td>

						</div>
					</div>

            </tr>
        </table>
                @endforeach
            @else
                <p>No Upcoming Lab Appointments</p>
            @endif
        </section>
        </div>

        <hr>

        <div class='col-md-12'>
        <h2>Support Groups</h2>
        <section class="cards upcoming-appointments">
            @if(!$supportGroups->isEmpty())
            <table class="table">
                <tr>
                <th scope="col">Support Group</th>
                <th scope="col">Conductor's Name</th>
                <th scope="col">Day</th>
                <th scope="col">Time and Date</th>
                <th scope="col">Description</th>
                <th scope="col">Leave</th>
                </tr>    
            @foreach($supportGroups as $supportGroup)
            <tr>
                <td> {{$supportGroup->name}}</td>
                <td>{{$supportGroup->supportGroupConductor->user->name}}</td>
                <td>{{$supportGroup->day}}</td>
                <td>{{$supportGroup->timing}}</td>
                <td>{{$supportGroup->description}}</td>
                <td> <a class="btn btn-primary" href="{{action('PatientController@leaveSupportGroup',['supportGroup_id'=>$supportGroup->id,'id'=>\Auth::user()->patient->id])}}">Leave</a></td>
                </tr>
            </table>
                @endforeach
            @else
                <p>You have not enrolled in any Support Group</p>
            @endif
            <hr>
            <a href="{{action('PatientController@showSupportGroups',['id'=>Auth::user()->patient->id])}}" class="btn btn-primary addAppointment">Join Support Group</a>
        </section>
        </div>
    </main>


</div>

<hr>


</div>

</div>


@endsection






