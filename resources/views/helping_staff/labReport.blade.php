@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add New Appointment') }}</div>

                <div class="card-body">
					<form method="POST" action="
					@if($labReport)
						/helpingStaff/updateLabReport
					@else
						/helpingStaff/addLabReport
					@endif
					">
						@csrf
						<input id="appointment_id" name="appointment_id" type="hidden" value={{$labAppointment_id}}>
						@if($labReport)
						<input id="labReport_id" name="labReport_id" type="hidden" value={{$labReport->id}}>
						@endif
						<div class="form-group row">
							<label for="labReport" class="col-md-4 col-form-label text-md-right">{{ __('Lab Report:') }}</label>

							<div class="col-md-6">
								<textarea id="labReport" col="25" row="10" class="form-control @error('labReport') is-invalid @enderror" name="labReport" autocomplete="appointmentTime">
									@if($labReport)
										{{$labReport->text}}
									@endif
								</textarea>
								@error('labReport')
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