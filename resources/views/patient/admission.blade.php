@extends('layouts.app')
@section('content')

<h2>Current Admission</h2>
<section class="cards upcoming-appointments">
	@if($admissions)
		@foreach($admissions as $admission)
			<div class="card appointment">
				<div class="appointment-content">
					<div class="appointment-text">
						<p>Staff Member: {{$admission->helpingStaff->user->name}}</p>
						<p>Start Date: {{$admission->from_date}}</p>
						<p>Number of Days: {{$admission->number_of_days}}</p>
					</div>
				</div>
			</div>
		@endforeach
	@else
		<p>No Admission Found</p>
	@endif
</section>
		
@endsection