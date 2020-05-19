@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register New Patient') }}</div>

                <div class="card-body">
				<form method="POST" action="/user/editProfile/{{$user->id}}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
							<input value="{{$user->name}}"id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
							<input id="email" value="{{$user->email}}" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                       
						<div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                            <div class="col-md-6">
								<input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" autocomplete="address"
									value="{{$user->address}}"
								>
								@error('address')
									<span class="alert alert-danger">{{ $message }}</span>
								@enderror
							</div>
		
						</div>
						
						<div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                            <div class="col-md-6">
                                <select id="gender" type="text" class="form-control @error('gender') is-invalid @enderror" name="gender">
									<option value="m"
									@if($user->gender == 'm')
										selected
									@endif
									>Male</option>
									<option value="f"
									@if($user->gender == 'f')
										selected
									@endif
									>Female</option>
								</select>
								@error('gender')
									<span class="alert alert-danger">{{ $message }}</span>
								@enderror
                            </div>
						</div>
						
						<div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>

                            <div class="col-md-6">
							<input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" autocomplete="phone" value="{{$user->phone}}">
								@error('phone')
									<span class="alert alert-danger">{{ $message }}</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
                            <label for="cnic" class="col-md-4 col-form-label text-md-right">{{ __('CNIC (with hypehns)') }}</label>

                            <div class="col-md-6">
                                <input value="{{$user->cnic}}" id="cnic" type="text" class="form-control @error('cnic') is-invalid @enderror" name="cnic" autocomplete="cnic">
								@error('cnic')
									<span class="alert alert-danger">{{ $message }}</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
                            <label for="age" class="col-md-4 col-form-label text-md-right">{{ __('Age') }}</label>

                            <div class="col-md-6">
                                <input id="age" value="{{$user->age}}" type="text" class="form-control @error('age') is-invalid @enderror" name="age" required autocomplete="age">
								@error('age')
									<span class="alert alert-danger">{{ $message }}</span>
								@enderror
							</div>
						</div>

						<input id="role" type="hidden" name="role" value='{{\Auth::user()->role}}'>

						@if($user->role == 'p')
						<div class="form-group row">
                            <label for="emergencey" class="col-md-4 col-form-label text-md-right">{{ __('Emergencey Contact') }}</label>

                            <div class="col-md-6">
                                <input value="{{$user->patient->emergencey_contact}}" id="emergencey" type="text" class="form-control @error('emergencey_contact') is-invalid @enderror" name="emergencey_contact" autocomplete="emergencey-contact">
								@error('emergencey_contact')
									<span class="alert alert-danger">{{ $message }}</span>
								@enderror
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
