@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Lab Appointment') }}</div>

                <div class="card-body">
                    <form method="POST" action="/patient/addAppointment">
						@csrf
						<input id="doctor_id" name="doctor_id" type="hidden" value="{{$doctor_id}}">
						<input id="patient_id" name="patient_id" type="hidden" value="{{$patient_id}}">
						<input id="prescription_id" name="prescription_id" type="hidden" value="{{$prescription_id}}">
						<div class="form-group row">
                            <label for="helping_staff_id" class="col-md-4 col-form-label text-md-right">{{ __('Lab Assistant:') }}</label>

                            <div class="col-md-6">
                                <select id="helping_staff_id" type="text" class="form-control @error('helping_staff_id') is-invalid @enderror" name="helping_staff_id">
									@foreach($helpingStaffs as $helpingStaff)
										<option value="{{$helpingStaff->id}}">@if($helpingStaff->user->gender=='f')
												Miss
												@else
												Mr.
												@endif
											{{$helpingStaff->user->name}}</option>
									@endforeach
								</select>
								@error('helping_staff_id')
									<div class="alert alert-danger">{{ $message }}</div>
								@enderror
                            </div>
						</div>

						<div class="form-group row">
                            <label for="lab_test_id" class="col-md-4 col-form-label text-md-right">{{ __('Lab Test:') }}</label>

                            <div class="col-md-6">
                                <select id="lab_test_id" type="text" class="form-control @error('lab_test_id') is-invalid @enderror" name="lab_test_id">
									@foreach($tests as $test)
										<option value="{{$test->id}}">{{$test->name}}</option>
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
							<input id="appointmentDate" type="date" min="{{Carbon\Carbon::now()->toDateString()}}" max="{{ Carbon\Carbon::now()->addDays(14)->toDateString()}}" class="form-control @error('appointmentDate') is-invalid @enderror" name="appointmentDate" autocomplete="appointmentDate">
								@error('appointmentDate')
									<div class="alert alert-danger">{{ $message }}</div>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label for="appointmentTime" class="col-md-4 col-form-label text-md-right">{{ __('Appointment Time:') }}</label>

							<div class="col-md-6">
								<input id="appointmentTime" type="time" min="09:00" max="19:00" class="form-control @error('appointmentTime') is-invalid @enderror" name="appointmentTime" autocomplete="appointmentTime">
								@error('appointmentTime')
									<div class="alert alert-danger">{{ $message }}</div>
								@enderror
							</div>
						</div>


						<div class="form-group row">
							<label for="notes" class="col-md-4 col-form-label text-md-right">{{ __('Pre Appointment Notes (if any):') }}</label>

							<div class="col-md-6">
								<textarea id="notes" col="20" row="5" class="form-control @error('notes') is-invalid @enderror" name="notes" autocomplete="appointmentTime">
								</textarea>
								@error('notes')
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