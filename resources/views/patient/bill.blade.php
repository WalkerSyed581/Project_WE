@extends('layouts.app')
@section('content')
<div class="patientPage billPage">
    <div class="patientHeader">
	<h1>Patient: {{\Auth::user()->name}}</h1>
    </div>
    <article class="content billContent">
		@if($fees)
			<p>Payment Method : Cash</p>
			<ul id="fees">
				<li class="doctor-fee">
					Total fee of all appointments: {{$fees['doctorFee']}} 
				</li>
				<li class="room-fee">
					Ward Fee: {{$fees['wardFee']}} 
				</li>
				<li>
					Total Fee of Support Groups: {{$fees['supportGroupFee']}}
				</li>
				<li class="dropright">
					<a href="#" class= "dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Total Fee of Lab Tests: {{$fees['totalTestFee']}}</a>
					<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
						@foreach($fees['testFees'] as $testFee)
							<li class="dropdown-item">{{$testFee['name']}} : {{$testFee['fee']}}</li>
						@endforeach
					</ul>
				</li>
				<li class="total-fee">
					Total: {{$fees['totalFee']}}
				</li>
			</ul>
		@else
			<p>No Bill found
		@endif
    </article>
</div>
@endsection
