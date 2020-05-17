@extends('layouts.app')
@section('content')

<h2>Current Prescriptions</h2>
<section class="cards upcoming-appointments">
	@if($prescription)
		<div class="card appointment">
			<h3>Doctor's Name: {{$doctorName}}</h3>
			<div class="appointment-content">
				<div class="appointment-text">
					<p>Condition: {{$prescription->condition}}</p>
					@if($prescription->notes)
					<p>Notes: {{$prescription->notes}}</p>
					@endif
					@foreach($drugs as $drug)
						<div class="drugs">
							<p>Drug Name: {{$drug->name}}</p>
							<p>Dose: {{$drug->dose}}</p>
						</div>
					@endforeach
				</div>
			</div>
		</div>
	@else
		<p>No Prescription Found</p>
	@endif
</section>
		
@endsection