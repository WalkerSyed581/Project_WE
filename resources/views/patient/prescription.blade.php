@extends('layouts.app')
@section('content')

<div class='container-fluid'>

<div class='row'>
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
<div class="upcoming-appointments col-md-9">
    <h2>Current Prescriptions</h2>
    @if($prescription)

    <table class="table">
        <tr>
        <th scope="col">Doctor's Name</th>
        <th scope="col">Condition</th>
        <th scope="col">Notes</th>
        <th scope="col">Drug Name</th>
        <th scope="col">Dose</th>
        </tr>
        
        <tr>
        <td>{{$doctorName}}</td>
        <td>{{$prescription->condition}}</td>
        <td>{{$prescription->notes}}</td>
        @foreach($drugs as $drug)
        <td>{{$drug->name}}</td>
        <td>{{$drug->dose}}</td>
        @endforeach
        </tr>
     
    </table>       
    
    @endif
</div>
</div>
</div>	
@endsection