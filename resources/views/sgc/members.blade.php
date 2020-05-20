@extends('layouts.app')
@section('content')
<div class="docHeader container-fluid ">
    <div class="row">
    <div class="col-md-3" >
        <h1 class="text-center " style="color:white">Mr. {{Auth::user()->name}}</h1>
    </div>
<div class="mainContent docContent col-md-9">
    <article>
		<h2>Members of Support Group: {{$supportGroup->name}}</h2>
        <section class="upcoming-appointments">
            @if(!$patients->isEmpty())
            <table class="table">
                <tr>
                    <th>Patient Name</th>
                    <th>Gender</th>
                    <th>Age</th>
                    <th>Email</th>
                    <th>Patient Profile</th>
                </tr>
            @foreach($patients as $patient)
            <tr>
                <td> {{$patient->user->name}}</td>
                <td>@if($patient->user->gender=='f')
                    Female
                   @elseif($patient->user->gender=='m')
                    Male
                   @endif
                </td>
                <td>{{$patient->user->age}}</td>
                <td>{{$patient->user->email}}</td>
                <td><a class="btn btn-danger" href="{{action('DoctorController@patientInfo',['id'=> Auth::user()->id,'patient_id'=> $docAppointment->patient->id])}}">View Patient Profile</a></td>
            </tr>
            </table>
                
                @endforeach
            @else
                <p>No members of this support group</p>
            @endif
        </section>
    </article>
</div>
</div>
</div>
@endsection
