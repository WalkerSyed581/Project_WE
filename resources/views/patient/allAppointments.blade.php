@extends('layouts.app')
@section('content')
<div>
    
<div class="patientHeader col-md-12 ">
    <div class="row ">
	@include('inc.aside')

<hr>
<div class="mainContent patientContent col-md-9">
    <article>
        
        <div class="col-md-12">
            <a  href=" {{action('PatientController@showBill',['id'=>\Auth::user()->patient->id])}}" class="btn btn-primary">Show Bill</a>
        </div>
        <hr>

        <div class="cards upcoming-appointments  col-md-12">
            <h2>Previous Doctor's Appointments</h2>
			@if(!$docAppointments->isEmpty())
			<div class="table-responsive">
            <table class="table">
                <tr>
                    <th>Doctor's Name</th>
                    <th>Doctor's Experise</th>
					<th>Time and Date</th>
					<th scope="col">Condition</th>
					<th scope="col">Drug Names</th>
					<th scope="col">Drug Dose</td>
                </tr>
                @foreach( $docAppointments as $docAppointment)
                <tr>
                    <td>{{$docAppointment->doctor->user->name}}</td>
                    <td>{{$docAppointment->doctor->specialization}}</td>
					<td>{{$docAppointment->time}}</td>
					@if($docAppointment->prescription)
						<td><p>{{$docAppointment->prescription->condition}}</p></td>
						<td>
							<ul>
							@foreach($docAppointment->prescription->drugs()->get() as $drug)
								<li>{{$drug->name}}</li>
							@endforeach
							</ul>
						</td>
						<td>
							<ul>
							@foreach($docAppointment->prescription->drugs()->get() as $drug)
								<li>{{$drug->dose}}</li>
							@endforeach
							</ul>
						</td>
					@endif
				</tr>
				@endforeach
            </table>
			</div>
            @else
			<p>No Doctor Appointments Found</p>
                
            @endif 
            </div>
        
        <hr>
        
        <div class="cards upcoming-appointments col-md-12">
            <h2>Previous Lab's Appointments</h2>
			@if(!$labAppointments->isEmpty())
			<div class="table-responsive">
            <table class="table">
                <tr>
                    <th>Conductor's Name</th>
                    <th>Time and Date</th>
                    <th>Show Lab Report</th>
                </tr>
                @foreach($labAppointments as $labAppointment)
                <tr>
                    <td>{{$labAppointment->helpingStaff->user->name}}</td>
                    <td>{{$labAppointment->time}}</td>
                  
                    <td>						
						<a class="btn btn-danger" href="{{action('PatientController@showLabReport',['id'=>\Auth::user()->patient->id,'labAppointment_id'=>$labAppointment->id])}}">Show Lab Report</a>
					</td>
               
				</tr>
				@endforeach
            </table>
			</div>
            @else
			<p>No Lab Appointments Found</p>
            @endif
            </div>      
    </article>
</div>
</div>
</div>
</div>
@endsection
