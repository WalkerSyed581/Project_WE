@extends('layouts.app')

@section('content')
	<a href="{{action('AdminController@showRegisterForm',['id'=>\Auth::id()])}}">Register User</a>
	
	<div style="position: relative; width:50vw; height:50vh;">
		<canvas id="patientChart"></canvas>
	</div>
	
	<div style="position: relative; width:50vw; height:50vh;">
		<canvas id="doctorChart"></canvas>
	</div>
	@push('scripts')
	<script>
	window.onload = function(){
		var ctx = document.getElementById('doctorChart').getContext('2d');
		var myChart = new Chart(ctx,getChart({!! json_encode($doctorMonths) !!},{!! json_encode($doctorCount) !!},"No of Doctors"));
		var ctx = document.getElementById('patientChart').getContext('2d');
		var myChart = new Chart(ctx,getChart({!! json_encode($patientMonths) !!},{!! json_encode($patientCount) !!},"No of Patients"));
		var ctx = document.getElementById('appointmentChart').getContext('2d');
		var myChart = new Chart(ctx,getChart({!! json_encode($appointmentMonths) !!},{!! json_encode($appointmentCount) !!},"No of Appointments"));
		var ctx = document.getElementById('admissionChart').getContext('2d');
			var myChart = new Chart(ctx,getChart({!! json_encode($admissionMonths) !!},{!! json_encode($admissionCount) !!},"No of Admissions"));
	}
	</script>
	@endpush
	<div style="position: relative; width:50vw; height:50vh;">
		<canvas id="appointmentChart"></canvas>
	</div>
	
	<div style="position: relative; width:50vw; height:50vh;">
		<canvas id="admissionChart"></canvas>
	</div>
@endsection

