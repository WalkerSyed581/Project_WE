@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Lab Appointment') }}</div>

                <div class="card-body">
                    <form method="POST" action="/helpingStaff/labAppointment">
						@csrf
						<input id="appointment_id" name="appointment_id" type="hidden" value={{$labAppointment->id}}>
						<input id="helping_staff_id" name="helping_staff_id" type="hidden" value={{$labAppointment->helpingStaff->id}}>
						
						<div class="form-group row">
                            <label for="lab_test_id" class="col-md-4 col-form-label text-md-right">{{ __('Lab Test:') }}</label>

                            <div class="col-md-6">
                                <select id="lab_test_id" type="text" class="form-control @error('lab_test_id') is-invalid @enderror" name="lab_test_id">
									@foreach($tests as $test)
										<option value="{{$test->id}}"
											@if($test->id === $labAppointment->test->id)
												selected
											@endif
											>{{$test->name}}</option>
									@endforeach
								</select>
								@error('lab_test_id')
									<div class="alert alert-danger">{{ $message }}</div>
								@enderror
                            </div>
						</div>

						<div class="form-group row">
							<label for="appointmentDate" class="col-md-4 col-form-label text-md-right">{{ __('Appointment Date:') }}</label>

							<div class="col-md-6">
							<input id="appointmentDate" type="date" min="{{Carbon\Carbon::now()->toDateString()}}" max="{{ Carbon\Carbon::now()->addDays(14)->toDateString()}}" class="form-control @error('appointmentDate') is-invalid @enderror" name="appointmentDate" autocomplete="appointmentDate"
								@if($labAppointment)
									value="{{Carbon\Carbon::parse($labAppointment->time)->toDateString()}}"
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
								@if($labAppointment)
									value="{{Carbon\Carbon::parse($docAppointment->time)->toTimeString()}}"
								@endif
								
								>
								@error('appointmentTime')
									<div class="alert alert-danger">{{ $message }}</div>
								@enderror
							</div>
						</div>


						<div class="form-group row">
							<label for="notes" class="col-md-4 col-form-label text-md-right">{{ __('Pre Appointment Notes (if any):') }}</label>

							<div class="col-md-6">
								<textarea id="notes" col="20" row="5" class="form-control @error('notes') is-invalid @enderror" name="notes" autocomplete="appointmentTime">
									@if($labAppointment)
										{{$labAppointment->notes}}
									@endif
								</textarea>
								@error('notes')
								<div class="alert alert-danger">{{ $message }}</div>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label for="notes" class="col-md-4 col-form-label text-md-right">{{ __('Pre Appointment Notes (if any):') }}</label>

							<div class="col-md-6">
								<textarea id="notes" col="20" row="5" class="form-control @error('notes') is-invalid @enderror" name="notes" autocomplete="appointmentTime">
									@if($docAppointment)
										{{$docAppointment->notes}}
									@endif
								</textarea>
								@error('notes')
								<div class="alert alert-danger">{{ $message }}</div>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label for="approved" class="col-md-4 col-form-label text-md-right">{{ __('Approve:') }}</label>

							<div class="col-md-6">
								<input id="approved" type="checkbox" class="form-control @error('approved') is-invalid @enderror" name="approved" autocomplete="approved"
								@if($docAppointment->approved)
									checked
								@endif
								>
									
								@error('approved')
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
@endsection