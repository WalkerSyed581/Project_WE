@extends('layouts.app')

@section('content')
<div class="col-md-12 container-fluid">
	<div class="row">
		@include('inc.aside')
		{{-- <hr> --}}
		{{-- <div style=" display: flex; justify-content: center;">
			<a class="btn btn-primary" href="{{action('AdminController@showRegisterForm',['id'=>\Auth::id()])}}">Register User</a>
			<a class="btn btn-primary ml-2" href="{{action('AdminController@showSupportGroups',['id'=>\Auth::id()])}}">Show Support Groups</a>
			<a class="btn btn-primary ml-2" href="{{action('UsersController@index',['id'=>\Auth::id()])}}">Manage Users</a>
		</div> --}}

		<div class="col-md-9">
			<div class="d-flex flex-wrap justify-content-between">
				<div class="graphContainer">
					<canvas id="patientChart"></canvas>
				</div>
				
				<div class="graphContainer">
					<canvas id="doctorChart"></canvas>
				</div>
				<div class="graphContainer" >
					<canvas id="appointmentChart"></canvas>
				</div>
				
				<div class="graphContainer" >
					<canvas id="admissionChart"></canvas>
				</div>
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
		</div>
	</div>
</div>
@endsection

