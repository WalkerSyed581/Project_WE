@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add/Edit Support Group') }}</div>

                <div class="card-body">
					<form method="POST" action="
					@if($supportGroup)
					/admin/supportGroup/edit/{{$supportGroup->id}}
					@else
					/admin/supportGroup/add
					@endif
					">
                        @csrf
						<input id="admin_id" name="admin_id" type="hidden" value={{\Auth::id()}}>
						
						<div class="form-group row">
							<label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name:') }}</label>

							<div class="col-md-6">
								<input id="name" class="form-control @error('name') is-invalid @enderror" name="name" autocomplete="name"
								@if($supportGroup)
									value ="{{$supportGroup->name}}"
								@else 
									value ="{{old('name')}}"
								@endif
								>
									
								@error('name')
								<div class="alert alert-danger">{{ $message }}</div>
								@enderror
							</div>
						</div>

                        <div class="form-group row">
                            <label for="conductor_id" class="col-md-4 col-form-label text-md-right">{{ __('Support Group Conductor:') }}</label>

                            <div class="col-md-6">
                                <select id="conductor_id" type="text" class="form-control @error('conductor_id') is-invalid @enderror" name="conductor_id">
										@foreach($supportGroupConductors as $supportGroupConductor)
											<option value="{{$supportGroupConductor->id}}"
												@if($supportGroup && $supportGroupConductor->id === $supportGroup->supportGroupConductor->id)
												selected
												@endif
												>{{$supportGroupConductor->user->name}}</option>
										@endforeach
								</select>
								@error('conductor_id')
									<div class="alert alert-danger">{{ $message }}</div>
								@enderror
                            </div>
						</div>

						
						<div class="form-group row">
							<label for="appointmentTime" class="col-md-4 col-form-label text-md-right">{{ __('Support Group Time:') }}</label>

							<div class="col-md-6">
								<input id="appointmentTime" type="time" min="09:00" max="19:00" class="form-control @error('appointmentTime') is-invalid @enderror" name="appointmentTime" autocomplete="appointmentTime"
								@if($supportGroup)
									value="{{Carbon\Carbon::parse($supportGroup->timing)->toTimeString()}}"
								@else
									value="{{old('appointmentTime')}}"
								@endif
								>
								@error('appointmentTime')
									<div class="alert alert-danger">{{ $message }}</div>
								@enderror
							</div>
						</div>

						<div class="form-group row">
                            <label for="day" class="col-md-4 col-form-label text-md-right">{{ __('Day:') }}</label>

                            <div class="col-md-6">
                                <select id="day" type="text" class="form-control @error('day') is-invalid @enderror" name="day">
										@foreach($days as $day)
											<option value="{{$day}}"
												@if($supportGroup && $day === $supportGroup->day)
												selected
												@endif
												>{{$day}}</option>
										@endforeach
								</select>
								@error('day')
									<div class="alert alert-danger">{{ $message }}</div>
								@enderror
                            </div>
						</div>

						<div class="form-group row">
							<label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description:') }}</label>

							<div class="col-md-6">
								<textarea id="description" col="20" row="5" class="form-control @error('description') is-invalid @enderror" name="description" autocomplete="description">@if($supportGroup){{$supportGroup->description}}@else{{old('description')}}@endif</textarea>
								@error('description')
								<div class="alert alert-danger">{{ $message }}</div>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label for="fee" class="col-md-4 col-form-label text-md-right">{{ __('Fee:') }}</label>

							<div class="col-md-6">
								<input id="fee" class="form-control @error('fee') is-invalid @enderror" name="fee" autocomplete="fee"
								@if($supportGroup)
									value ="{{$supportGroup->fee}}"
								@else 
									value ="{{old('fee')}}"
								@endif
								>
									
								@error('fee')
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