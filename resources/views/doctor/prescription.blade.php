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
								<form method="POST" action="
								@if($prescription)
								/doctor/updatePrescription
								@else
								/doctor/addPrescription
								@endif">
									@csrf
									@if($prescription)
										<input id="prescription_id" name="prescription_id" type="hidden" value={{$prescription->id}}>
									@endif
									<input id="appointment_id" name="appointment_id" type="hidden" value={{$appointment_id}}>

									<div class="form-group row">
										<label for="condition" class="col-md-4 col-form-label text-md-right">{{ __('Condition:') }}</label>
			
										<div class="col-md-8">
											<input id="condition" type="text" 
											class="form-control @error('condition') is-invalid @enderror" 
											name="condition"
												@if($prescription)
													value="{{$prescription->condition}}"
												@endif
											
											>
											@error('condition')
												<div class="alert alert-danger">{{ $message }}</div>
											@enderror
										</div>
									</div>
			
									<div class="form-group row">
										<label for="notes" class="col-md-4 col-form-label text-md-right">{{ __('Prescription Notes:') }}</label>
			
										<div class="col-md-8">
										<input id="notes" type="text" 
											   class="form-control @error('notes') is-invalid @enderror" 
											   name="notes" autocomplete="notes"
											   @if($prescription)
													value="{{$prescription->notes}}"
												@endif
										>
											@error('notes')
												<div class="alert alert-danger">{{ $message }}</div>
											@enderror
										</div>
									</div>
									@foreach($drugs as $drug)
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="drugName">Drug Name</label>
												<input type="text" class="form-control drugName" name="drugName" value="{{$drug->name}}">
												@error('drugName')
													<div class="alert alert-danger">{{ $message }}</div>
												@enderror
											</div>
											<div class="form-group col-md-6">
												<label for="dose">Dose</label>
												<input type="text" class="form-control dose" name="dose" value="{{$drug->dose}}">
												@error('dose')
													<div class="alert alert-danger">{{ $message }}</div>
												@enderror
											</div>
										</div>
									@endforeach
									@if(!$prescription)
										<div class="form-group row">
											<label for="numberOfDrugs" class="col-md-4 col-form-label text-md-right">{{ __('Number Of Drugs:') }}</label>
				
											<div class="col-md-8">
											<input id="numberOfDrugs" type="text" 
												class="form-control @error('numberOfDrugs') is-invalid @enderror" 
												name="numberOfDrugs" autocomplete="numberOfDrugs">
												@error('numberOfDrugs')
													<div class="alert alert-danger">{{ $message }}</div>
												@enderror
											</div>
										</div>
									@endif
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