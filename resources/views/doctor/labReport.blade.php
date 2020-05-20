@extends('layouts.app')
@section('content')
<div class="container-fluid col-md-12">
    <div class="row">
    @include('inc.aside')


<div class="mainContent docContent col-md-9">
    <article class="content appointment-content">
        <section class="medical-report">
            <table class="table">
                <tr>
                    <th>Name</th>
                    <td>{{$patient->name}}</td>
                </tr>
                <tr>
                    <th>Age</th>
                    <td>{{$patient->age}}</td>
                </tr>
                <tr>
                    <th>Prescription Condition</th>
                    <td>{{$prescription->conditions}}</td>
                </tr>
                <tr>
                    <th>Prescription Notes</th>
                    <td>{{$prescription->notes}}</td>
				</tr>
				<tr>
                    <th>Test Conductor </th>
                    <td>{{$labAppointment->helpingStaff->user->name}}</td>
				</tr>
				<tr>
                    <th>Test Name </th>
                    <td>{{$labAppointment->test->name}}</td>
				</tr>
				@foreach($drugs as $drug)
					<tr>
						<th>{{$drug->name}}</th>
						<td>{{$drug->dose}}</td>
					</tr>
				@endforeach
			</table>
			<h2>Lab Report</h2>
            @if($labReport)
                <div class="card appointment">
					<div class="appointment-content">
						<div class="appointment-text">
							{{$labReport->}}
						</div>
					</div>
				</div>
            @else
                <p>No Lab Report found for this prescription</p>
            @endif
        </section>
    </article>
</div>
</div>
</div>
@endsection