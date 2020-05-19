@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register New Patient') }}</div>

                <div class="card-body">
                    <form method="POST" action="/admin/registerUser">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
						</div>
						
						<div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <input value="{{ old('address') }}" id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" autocomplete="address">
								{{-- <span class="text-danger">
									<strong>{{ $errors->first('address') }}</strong>
								</span> --}}
								@error('address')
									<div class="alert alert-danger">{{ $message }}</div>
								@enderror
							</div>
		
						</div>
						
						<div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                            <div class="col-md-6">
                                <select id="gender" type="text" class="form-control @error('gender') is-invalid @enderror" name="gender">
									<option value="m" selected>Male</option>
									<option value="f">Female</option>
								</select>
								@error('gender')
									<div class="alert alert-danger">{{ $message }}</div>
								@enderror
                            </div>
						</div>
						
						<div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>

                            <div class="col-md-6">
                                <input value="{{ old('phone') }}" id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" autocomplete="phone">
								@error('phone')
									<div class="alert alert-danger">{{ $message }}</div>
								@enderror
							</div>
						</div>

						<div class="form-group row">
                            <label for="cnic" class="col-md-4 col-form-label text-md-right">{{ __('CNIC (with hypehns)') }}</label>

                            <div class="col-md-6">
                                <input value="{{ old('cnic') }}" id="cnic" type="text" class="form-control @error('cnic') is-invalid @enderror" name="cnic" autocomplete="cnic">
								@error('cnic')
									<div class="alert alert-danger">{{ $message }}</div>
								@enderror
							</div>
						</div>

						<div class="form-group row">
                            <label for="age" class="col-md-4 col-form-label text-md-right">{{ __('Age') }}</label>

                            <div class="col-md-6">
                                <input value="{{ old('age') }}" id="age" type="text" class="form-control @error('age') is-invalid @enderror" name="age" required autocomplete="age">
								@error('age')
									<div class="alert alert-danger">{{ $message }}</div>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>
						
							<div class="col-md-6">
								<select id="role" type="text" class="form-control" name="role">
									<option value="p" selected>Patient</option>
									<option value="d">Doctor</option>
									<option value="sgc">Support Group Conductor</option>
									<option value="hs">Helping Staff</option>
									<option value="a">Admin</option>
								</select>
							</div>
						</div>
						

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

