@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
				<div class="card-header">{{ __('Admit Patient') }}</div>
				<div class="card-body">
					<h3>Patient's Name: {{$patient->user->name}}</h3>
					<div class="appointment-content">
						<div class="appointment-text">
							<form method="POST" action="
							@if($admission)
							/helpingStaff/updateAdmission/{{$admission->id}}
							@else
							/doctor/admitPatient
							@endif">
								@csrf
								@if($admission)
									<input id="admission_id" name="admission_id" type="hidden" value={{$admission->id}}>
									<input id="helping_staff_id" name="helping_staff_id" type="hidden" value={{$admission->helping_staff_id}}>
								@endif
								@if(!$admission)
									<input id="patient_id" name="patient_id" type="hidden" value={{$patient->id}}>
									<div class="form-group row">
										<label for="helping_staff_id" class="col-md-4 col-form-label text-md-right">{{ __('Lab Assistant:') }}</label>
			
										<div class="col-md-6">
											<select id="helping_staff_id" type="text" class="form-control @error('helping_staff_id') is-invalid @enderror" name="helping_staff_id">
												@foreach($helpingStaffs as $helpingStaff)
													<option value="{{$helpingStaff->id}}">{{$helpingStaff->user->name}}</option>
												@endforeach
											</select>
											@error('helping_staff_id')
												<div class="alert alert-danger">{{ $message }}</div>
											@enderror
										</div>
									</div>
								@endif
								
								@if($admission)
								<div class="form-group row">
									<label for="patient_id" class="col-md-4 col-form-label text-md-right">{{ __('Doctor:') }}</label>
		
									<div class="col-md-6">
										<select id="patient_id" type="text" class="form-control @error('patient_id') is-invalid @enderror" name="patient_id">
												@foreach($allPatients as $allPatient)
													<option value="{{$allPatient->id}}"
														@if($allPatient->id === $admission->patient->id)
														selected
														@endif
														>{{$allPatient->user->name}}</option>
												@endforeach
										</select>
										@error('patient_id')
											<div class="alert alert-danger">{{ $message }}</div>
										@enderror
									</div>
								</div>
								@endif
								<div class="form-group row">
									<label for="ward_id" class="col-md-4 col-form-label text-md-right">{{ __('Ward:') }}</label>
		
									<div class="col-md-6">
										<select id="ward_id" class="form-control @error('ward_id') is-invalid @enderror" name="ward_id">
											@foreach($wards as $ward)
												<option value="{{$ward->id}}"
													@if($admission && $ward->id === $admission->ward->id)
														selected
													@endif
													>Ward Number-{{$ward->id}}, (Capacity: {{$ward->capacity}})</option>
											@endforeach
										</select>
										@error('ward_id')
											<div class="alert alert-danger">{{ $message }}</div>
										@enderror
									</div>
								</div>

								<div class="form-group row">
									<label for="number_of_days" class="col-md-4 col-form-label text-md-right">{{ __('Number Of Days:') }}</label>
		
									<div class="col-md-6">
										<input id="number_of_days" type="number" min="1"
										class="form-control @error('number_of_days') is-invalid @enderror" 
										name="number_of_days"
											@if($admission)
												value="{{$admission->number_of_days}}"
											@endif
										
										>
										@error('number_of_days')
											<div class="alert alert-danger">{{ $message }}</div>
										@enderror
									</div>
								</div>
		
								
								<div class="form-group row">
									<label for="appointmentDate" class="col-md-4 col-form-label text-md-right">{{ __('Admission Date:') }}</label>
		
									<div class="col-md-6">
									<input id="appointmentDate" type="date" min="{{Carbon\Carbon::now()->toDateString()}}" max="{{ Carbon\Carbon::now()->addDays(14)->toDateString()}}" class="form-control @error('appointmentDate') is-invalid @enderror" name="appointmentDate" autocomplete="appointmentDate"
										@if($admission)
											value="{{Carbon\Carbon::parse($admission->from_date)->toDateString()}}"
										@endif
									
									>
										@error('appointmentDate')
											<div class="alert alert-danger">{{ $message }}</div>
										@enderror
									</div>
								</div>
		
								<div class="form-group row">
									<label for="appointmentTime" class="col-md-4 col-form-label text-md-right">{{ __('Appointment Time:') }}</label>
		
									<div class="col-md-6">
										<input id="appointmentTime" type="time" min="09:00" max="19:00" class="form-control @error('appointmentTime') is-invalid @enderror" name="appointmentTime" autocomplete="appointmentTime"
										@if($admission)
											value="{{Carbon\Carbon::parse($admission->from_date)->toTimeString()}}"
										@endif
										
										>
										@error('appointmentTime')
											<div class="alert alert-danger">{{ $message }}</div>
										@enderror
									</div>
								</div>

								<div class="form-group row">
									<label for="discharged" class="col-md-4 col-form-label text-md-right">{{ __('Discharge:') }}</label>
		
									<div class="col-md-6">
										<input id="discharged" type="checkbox" class="form-control @error('discharged') is-invalid @enderror" name="discharged" autocomplete="discharged"
										@if($admission && $admission->discharged)
											checked
										@else
											disabled
										@endif
										>
											
										@error('discharged')
										<div class="alert alert-danger">{{ $message }}</div>
										@enderror
									</div>
								</div>

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
		</div>
	</div>
</div>
@endsection