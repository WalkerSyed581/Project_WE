@extends('layouts.app')
@section('content')

<h2>Current Prescriptions</h2>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
					<div class="card-header">{{ __('Edit/Add Prescription') }}</div>
					<div class="card-body">
						<h3>Patient's Name: {{$patient->user->name}}</h3>
						<div class="appointment-content">
							<div class="appointment-text">
								<form method="POST" action="/doctor/addDrugs">
									@csrf
									<input id="prescription_id" name="prescription_id" type="hidden" value={{$prescription_id}}>

									@for (; $noOfDrugs != 0;$noOfDrugs--)
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="drugName">Drug Name</label>
												<input type="text" class="form-control drugName" name="drugName">
												@error('drugName')
													<div class="alert alert-danger">{{ $message }}</div>
												@enderror
											</div>
											<div class="form-group col-md-6">
												<label for="dose">Dose</label>
												<input type="text" class="form-control dose" name="dose">
												@error('dose')
													<div class="alert alert-danger">{{ $message }}</div>
												@enderror
											</div>
										</div>
									@endfor
									
									<div class="form-group row mb-0">
										<div class="col-md-6 offset-md-4">
											<button type="submit" class="btn btn-primary">
												{{ __('Submit') }}
											</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				@endif
			</div>
		</div>
		@if($prescription)
			<a class="btn btn-danger" href="{{action('DoctorController@addLabAppointment',['patient_id'=> $patient->id,'prescription_id'=> $prescription->id])}}">View Prescription</a>
		@endif
	</div>
</div>
<script src="{{ asset('js/addDrugs.js') }}" defer></script>
@endsection