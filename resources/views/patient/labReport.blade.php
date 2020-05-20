@extends('layouts.app')
@section('content')
<article class="lab-test">
    <div class="row">
        <div class="col-md-3 bg-dark" >
            <h1 class="text-center position-fixed" style="color:white">{{Auth::user()->name}}</h1>
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
    <div class="card-body lab-report col-md-9">
            {!! $labReport->report_text !!}
            <button class="btn btn-primary download-report">Download PDF</button>
    </div>
   
</article>
@endsection
