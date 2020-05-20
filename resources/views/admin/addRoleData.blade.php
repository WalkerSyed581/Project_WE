@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register New Patient') }}</div>

                <div class="card-body">
					<form method="POST" action="
					@if(!$roleData)
						@if($role === 'd')
						/doctor/store
						@elseif($role === 'p')
						/patient/store
						@elseif($role === 'sgc')
						/supportGroupConductor/store
						@elseif($role === 'hs')
						/helpingStaff/store
						@endif
					@else 
						@if($role === 'd')
						/doctor/update/{{$roleData->id}}
						@elseif($role === 'p')
						/patient/update/{{$roleData->id}}
						@elseif($role === 'sgc')
						/supportGroupConductor/update/{{$roleData->id}}
						@elseif($role === 'hs')
						/helpingStaff/update/{{$roleData->id}}
						@endif
					@endif
										">
						@csrf
						@if(!$roleData)
							<input name="role" value="{{$role}}" type="hidden">
							<input name="user_id" value="{{$user_id}}" type="hidden">
						@else 
							<input name="role_id" value="{{$roleData->id}}" type="hidden">
						@endif
						@if($role==='d' || $role === 'sgc' || $role === 'hs')
							<div class="form-group row">
								<label for="salary" class="col-md-4 col-form-label text-md-right">{{ __('Salary') }}</label>

								<div class="col-md-6">
									<input id="salary" type="text" class="form-control @error('salary') is-invalid @enderror" name="salary" autocomplete="salary"
										@if($roleData)
											value="{{$roleData->salary}}"
										@else
											value="{{old('salary')}}"
										@endif
									>
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
									<input id="emergencey" type="text" class="form-control @error('emergencey_contact') is-invalid @enderror" name="emergencey_contact" autocomplete="emergencey-contact"
										@if($roleData)
											value="{{$roleData->emergencey_contact}}"
										@else
											value="{{old('emergencey_contact')}}"
										@endif
									>
									@error('emergencey_contact')
										<span class="alert alert-danger">{{ $message }}</span>
									@enderror
								</div>
							</div>
						@elseif($role === 'd')
							
							<div class="form-group row">
								<label for="specialization" class="col-md-4 col-form-label text-md-right">{{ __('Specialization') }}</label>

								<div class="col-md-6">
									<input id="specialization" type="text" class="form-control @error('specialization') is-invalid @enderror" name="specialization" autocomplete="specialization"
									@if($roleData)
										value="{{$roleData->specialization}}"
									@else
										value="{{old('specialization')}}"
									@endif
									
									>
									@error('specialization')
										<span class="alert alert-danger">{{ $message }}</span>
									@enderror
								</div>
							</div>
							<div class="form-group row">
								<label for="fee" class="col-md-4 col-form-label text-md-right">{{ __('Fee') }}</label>

								<div class="col-md-6">
									<input id="fee" type="text" class="form-control @error('fee') is-invalid @enderror" name="fee" autocomplete="fee"
									@if($roleData)
										value="{{$roleData->fee}}"
									@else
										value="{{old('fee')}}"
									@endif
									
									>
									@error('fee')
										<span class="alert alert-danger">{{ $message }}</span>
									@enderror
								</div>
							</div>
							<div class="form-group row">
								<label for="startTime" class="col-md-4 col-form-label text-md-right">{{ __('Start Time') }}</label>

								<div class="col-md-6">
									<input id="startTime" type="time" min="09:00" max="19:00" class="form-control @error('startTime') is-invalid @enderror" name="start_time" autocomplete="startTime"
									@if($roleData)
										value="{{$roleData->starting_time}}"
									@else
										value="{{old('start_time')}}"
									@endif
									
									>
									@error('start_time')
										<span class="alert alert-danger">{{ $message }}</span>
									@enderror
								</div>
							</div>
							<div class="form-group row">
								<label for="endTime" class="col-md-4 col-form-label text-md-right">{{ __('End Time') }}</label>

								<div class="col-md-6">
									<input id="endTime" type="time" min="10:00" max="19:00" class="form-control @error('endTime') is-invalid @enderror" name="end_time" autocomplete="endTime"
									@if($roleData)
										value="{{$roleData->end_time}}"
									@else
										value="{{old('end_time')}}"
									@endif
									>
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
										<option value="ws" selected
										@if($roleData && $roleData->role == 'ws')
											selected
										@endif
										>Ward Staff</option>
										<option value="ls"
										@if($roleData && $roleData->role == 'ls')
											selected
										@endif
										>Lab Staff</option>
										<option value="rc"
										@if($roleData && $roleData->role == 'rc')
											selected
										@endif
										>Receptionist</option>
									</select>
								</div>
							</div>
						
						@endif
						
						

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
						</div>
						@if($roleData)
							<div class="form-group row mb-0">
								<div class="col-md-6 offset-md-4">
									<a class="btn btn-primary" href="
									@if($role === 'd')
										/doctor/{{$roleData->user_id}}/delete/{{$roleData->id}}
									@elseif($role === 'p')
										/patient/{{$roleData->user_id}}/delete/{{$roleData->id}}
									@elseif($role === 'sgc')
										/supportGroupConductor/{{$roleData->user_id}}/delete/{{$roleData->id}}
									@elseif($role === 'hs')
										/helpingStaff/{{$roleData->user_id}}/delete/{{$roleData->id}}
									@endif">
										{{ __('Delete User') }}
									</a>
								</div>
							</div>
						@endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

