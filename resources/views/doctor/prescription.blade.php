@extends('layouts.app')
@section('content')

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
										<input id="number_of_drugs" name="number_of_drugs" type="hidden" value={{count($drugs)}}>
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
										<input id="drug_id{{$loop->index}}" name="drug_id{{$loop->index}}" type="hidden" value={{$drug->id}}>
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="drugName">Drug Name</label>
												<input type="text" class="form-control drugName" name="drugName{{$loop->index}}" value="{{$drug->name}}">
												@error('drugName{{$loop->index}}')
													<div class="alert alert-danger">{{ $message }}</div>
												@enderror
											</div>
											<div class="form-group col-md-6">
												<label for="dose">Dose</label>
												<input type="text" class="form-control dose" name="dose{{$loop->index}}" value="{{$drug->dose}}">
												@error('dose{{$loop->index}}')
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
			</div>
			<div class="mt-4">
			@if($prescription)
			<a class="btn btn-danger" href="{{action('DoctorController@showAdmitForm',['id'=> \Auth::user()->doctor->id,'patient_id'=> $patient->id])}}">Admit Patient</a>
			<a class="btn btn-danger" href="{{action('DoctorController@showLabAppointmentForm',['id'=> \Auth::user()->doctor->id,'appointment_id'=> $prescription->doctor_appointment_id])}}">Add Lab Appointment</a>
			@endif
			@if($prescription->labAppointments())
				<a class="btn btn-danger" href="{{action('DoctorController@showLabAppointments',['id'=> \Auth::user()->doctor->id,'prescription_id'=> $prescription->id])}}">Show Lab Appointments</a>
			@endif
			</div>
		</div>
		
	</div>
</div>
@endsection