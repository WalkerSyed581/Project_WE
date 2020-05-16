@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register New Patient') }}</div>

                <div class="card-body">
					<form method="POST" action="
					@if($role === 'd')
					/doctor/store
					@elseif($role === 'p')
					/patient/store
					@elseif($role === 'sgc')
					/supportGroupConductor/store
					@elseif($role === 'hs')
					/helpingStaff/store
					@endif
										">
						@csrf
						<input name="role" value="{{$role}}" type="hidden">
						<input name="user_id" value="{{$user_id}}" type="hidden">
						@if($role==='d' || $role === 'sgc' || $role === 'hs')
							<div class="form-group row">
								<label for="salary" class="col-md-4 col-form-label text-md-right">{{ __('Salary') }}</label>

								<div class="col-md-6">
									<input id="salary" type="text" class="form-control @error('salary') is-invalid @enderror" name="salary" autocomplete="emergencey-contact">
									@error('salary')
										<span class="alert alert-danger">{{ $message }}</span>
									@enderror
								</div>
							</div>
						@endif
						@if($role === 'p')
							<div class="form-group row">
								<label for="emergencey" class="col-md-4 col-form-label text-md-right">{{ __('Emergencey Contact') }}</label>

								<div class="col-md-6">
									<input id="emergencey" type="text" class="form-control @error('emergencey_contact') is-invalid @enderror" name="emergencey_contact" autocomplete="emergencey-contact">
									@error('emergencey_contact')
										<span class="alert alert-danger">{{ $message }}</span>
									@enderror
								</div>
							</div>
						@elseif($role === 'd')
							
							<div class="form-group row">
								<label for="specialization" class="col-md-4 col-form-label text-md-right">{{ __('Specialization') }}</label>

								<div class="col-md-6">
									<input id="specialization" type="text" class="form-control @error('specialization') is-invalid @enderror" name="specialization" autocomplete="specialization">
									@error('specialization')
										<span class="alert alert-danger">{{ $message }}</span>
									@enderror
								</div>
							</div>
							<div class="form-group row">
								<label for="fee" class="col-md-4 col-form-label text-md-right">{{ __('Fee') }}</label>

								<div class="col-md-6">
									<input id="fee" type="text" class="form-control @error('fee') is-invalid @enderror" name="fee" autocomplete="fee">
									@error('fee')
										<span class="alert alert-danger">{{ $message }}</span>
									@enderror
								</div>
							</div>
							<div class="form-group row">
								<label for="startTime" class="col-md-4 col-form-label text-md-right">{{ __('Start Time') }}</label>

								<div class="col-md-6">
									<input id="startTime" type="time" min="09:00" max="19:00" class="form-control @error('startTime') is-invalid @enderror" name="start_time" autocomplete="startTime">
									@error('start_time')
										<span class="alert alert-danger">{{ $message }}</span>
									@enderror
								</div>
							</div>
							<div class="form-group row">
								<label for="endTime" class="col-md-4 col-form-label text-md-right">{{ __('End Time') }}</label>

								<div class="col-md-6">
									<input id="endTime" type="time" min="10:00" max="19:00" class="form-control @error('endTime') is-invalid @enderror" name="end_time" autocomplete="endTime">
									@error('end_time')
										<span class="alert alert-danger">{{ $message }}</span>
									@enderror
								</div>
							</div>							

						@elseif($role === 'hs')
							<div class="form-group row">
								<label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>
							
								<div class="col-md-6">
									<select id="role" type="text" class="form-control" name="role">
										<option value="ws" selected>Ward Staff</option>
										<option value="ls">Lab Staff</option>
										<option value="rc" selected>Receptionist</option>
									</select>
								</div>
							</div>
						
						@endif
						
						

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Next') }}
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

