@extends('layouts.app')

@section('content')


<main class="loginPage">
    <div class="row">
        <div class="col-md-3 bg-dark" >
            <h1 class="text-center position-fixed" style="color:white">{{Auth::user()->name}}</h1>
            <aside class="col-md-3  p-0 flex-shrink-1 sticky-top" style="margin-top:30px">
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
            <h2>Support Groups</h2>
    @if ($supportGroups)
    <table class='table'>
        <tr>
            <th scope="col">Support Group Title</th>
            <th scope="col">Conductor</th>
            <th scope="col">Time</th>
            <th scope="col">Day</th>
            <th scope="col">Fee</th>
            <th scope="col">Description</th>
            <th scope="col">Join Support Group</th>
        </tr>
        @foreach($supportGroups as $supportGroup)
        <tr>
            <td>{{$supportGroup->name}}</td>
            <td>{{$supportGroup->supportGroupConductor->user->name}}</td>
            <td> {{$supportGroup->timing}}</td>
            <td>{{$supportGroup->day}}</td>
            <td>{{$supportGroup->fee}}</td>
            <td>{{$supportGroup->description}}</td>
            <td> @if(\Auth::user()->role()=='p')
                <a href="{{action('PatientController@joinSupportGroup',['id'=>\Auth::user()->patient->id,'supportGroup_id' => $supportGroup->id])}}" class="btn btn-danger">Join Support Group</a>
         @elseif(\Auth::user()->role()=='a')
             <a href="{{action('SupportGroupController@edit',['id'=>\Auth::user()->id,'supportGroup_id' => $supportGroup->id])}}" class="btn btn-danger">Edit Support Group</a>
             <a href="{{action('SupportGroupController@destroy',['id'=>\Auth::user()->id,'supportGroup_id' => $supportGroup->id])}}" class="btn btn-danger">Remove Support Group</a>
         @endif
        </td>
            
        </tr>

        
        @endforeach
    </table>
        </div>
    @else
        <p>No Support Groups are currently on going</p>
    @endif

</main>
@endsection