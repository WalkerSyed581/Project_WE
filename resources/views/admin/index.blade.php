@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div>
        <h1 class="text-center">{{Auth::user()->name}}</h1>
    </div>
    <hr>
    <div style=" display: flex; justify-content: center;">
	<a class="btn btn-primary" href="{{action('AdminController@showRegisterForm',['id'=>\Auth::id()])}}">Register User</a>
    </div>
</div>
        <hr>
<div >
    <div class="row col-md-12">
	<div class="col-md-6" style="position: static; width:50vw; height:50vh;">
		<canvas id="patientChart"></canvas>
	</div>
	
	<div class="col-md-6" style="position: static; width:50vw; height:50vh;">
		<canvas id="doctorChart"></canvas>
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
    
        <div class="row col-md-12">
        <div class="col-md-6" style="position: relative;  width:50vw; height:50vh;">
		<canvas id="appointmentChart"></canvas>
        </div>
	
    <div class="col-md-6" style="position: relative;  width:50vw; height:50vh;">
		<canvas id="admissionChart"></canvas>
    </div>
  
</div>
</div>
</div>
@endsection

