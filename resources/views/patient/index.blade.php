@extends('layouts.app')
@section('content')

<div class="patientPage container-fluid ">
    <div class="patientHeader row">
    <div class="col-md-3 bg-dark" >
        <h1 class="text-center " style="color:white">{{Auth::user()->name}}</h1>
        <aside class="col-md-3 p-0 flex-shrink-1 sticky-top" style="margin-top:30px">
            <!--fixed-top/sticky-top-->
            <nav class="navbar navbar-expand navbar-dark  flex-md-column flex-row align-items-start py-2">
                <div class="collapse navbar-collapse">
                    <ul class="flex-md-column flex-row navbar-nav w-100 justify-content-between ">
                        
                        <li class="nav-item">
                            <a class="nav-link pl-0" href="#"><i class="fa fa-book fa-fw"></i> <span class="d-none d-md-inline">Lab Appointment</span></a>
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

    <div class="mainContent patientContent patientHeader col-md-9">
   
     
       
        <main>
        <div  class='col-md-12'>
        <a  href=" {{action('PatientController@showBill',['id'=>Auth::user()->id])}}" class="btn btn-primary">Show Bill</a>
        </div>

        <hr>
        
        <div class='col-md-12'>
        <h2 > Upcoming Doctor's Appointments</h2>
        <section class="upcoming-appointments">
            @if($docAppointments)
            <table class="table">
                <tr>
                <th scope="col">Doctor's Name:</th>
                <th scope="col">Doctor's Experise</th>
                <th scope="col">Ailment Notes</th>
                <th scope="col">Time and Date</th>
                <th scope="col">Cancel</th>
                <th scope="col">View Prescription</th>
                </tr>
            
                @foreach( $docAppointments as $docAppointment)
                <tr>
                    <td>{{$docAppointment->doctor->user->name}}</td>
                    <td>{{$docAppointment->doctor->specialization}}</td>
                    <td> {{$docAppointment->notes}}</td>
                    <td>{{$docAppointment->time}}</td>
                    <td><a class="btn btn-primary" href="{{action('DoctorAppointmentController@destroy',['id'=> $docAppointment->id])}}">Cancel</a></td>
                    <td><a class="btn btn-primary" href="{{action('PatientController@showPrescription',['id'=> Auth::user()->id,'appointment_id'=> $docAppointment->id])}}">View Prescription</a></td>
                </tr>  
            
                
                @endforeach
                </table>
            @else
                <p>No Upcoming Appointments</p>
                
            @endif 
            <hr>
            <a class="btn btn-primary" href="{{action('PatientController@showAppointmentForm',['id'=>Auth::user()->id])}}" class="btn btn-danger addAppointment">Add New Appointment</a>
            <a class="btn btn-primary" href="{{action('PatientController@appoinmentArchive',['id'=>Auth::user()->id])}}" class="btn btn-danger appointmentArchive">Show Previous Appointments</a>
		</section>
        </div>
        
        <hr>

        <div class="col-md-12">
        <h2> Upcoming Lab's Appointments</h2>
        <section class=" upcoming-appointments">
            @if($labAppointments)
            <table class="table">
                <tr>
                <th scope="col">Conductor's Name</th>
                <th scope="col">Time and Date:</th>
                <th scope="col">Test</th>
                <th scope="col">Cancel</th>
                <th scope="col">Show Lab Report</th>
                </tr>    
            @foreach($labAppointments as $labAppointment)
            <tr>
            <td> {{$labAppointment->helpingStaff->user->name}}</td>
            <td>{{$labAppointment->time}}</td>
            <td>{{$labAppointment->labTest->name}}</td>
            <td><a class="btn btn-primary" href="{{action('LabAppointmentController@destroy',['id'=>$labAppointment->id])}}">Cancel</a></td>
            <a class="btn btn-primary" href="{{action('PatientController@showLabReport',['id'=>Auth::user()->id,'labAppointment_id'=>$labAppointment->id])}}">Show Lab Report</a>

						</div>
					</div>

            </tr>
        
                @endforeach
                </table>
            @else
                <p>No Upcoming Lab Appointments</p>
            @endif
        </section>
        </div>

        <hr>

        <div class='col-md-12'>
        <h2>Support Groups</h2>
        <section class="cards upcoming-appointments">
            @if($supportGroups)
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
            
                @endforeach
                </table>
            @else
                <p>You have not enrolled in any Support Group</p>
            @endif
            <hr>
            <a href="{{action('PatientController@showSupportGroups',['id'=>Auth::user()->id])}}" class="btn btn-primary addAppointment">Join Support Group</a>
        </section>
        </div>
    </main>


</div>

<hr>


</div>

</div>


@endsection






