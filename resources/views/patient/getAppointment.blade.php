@extends('layouts.app')

@section('content')
<div class="container col-md-12 ">
    <div class="row ">
        <div class="col-md-3 bg-dark" >
            <h1 class="text-center sticky-top" style="color:white">{{Auth::user()->name}}</h1>
            <aside class="col-md-3 p-0 flex-shrink-1 sticky-top" style="margin-top:30px">
                <!--fixed-top/sticky-top-->
                <nav class="navbar navbar-expand navbar-dark  flex-md-column flex-row align-items-start py-2">
                    <div class="collapse navbar-collapse">
                        <ul class="flex-md-column flex-row navbar-nav w-100 justify-content-between ">
                            
                            <li class="nav-item">
                                <a class="nav-link pl-0" href=" #"><i class="fa fa-book fa-fw"></i> <span class="d-none d-md-inline">Lab Appointment</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pl-0" href=" #"><i class="fa fa-cog fa-fw"></i> <span class="d-none d-md-inline">Prescriptions</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pl-0" href=" #"><i class="fa fa-heart codeply fa-fw"></i> <span class="d-none d-md-inline">Appointments</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pl-0" href=" #"><i class="fa fa-heart codeply fa-fw"></i> <span class="d-none d-md-inline">Current Admission</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pl-0"href=" #"><i class="fa fa-heart codeply fa-fw"></i> <span class="d-none d-md-inline">All Admissions</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pl-0" href=" {{action('PatientController@showBill',['id'=>Auth::user()->id])}}"><i class="fa fa-heart codeply fa-fw"></i> <span class="d-none d-md-inline">Bills</span></a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </aside>
       
        </div>
    <div class="col-md-9 row justify-content-center">
        <div class="">
            <div class="card">
                <div class="card-header">{{ __('Add New Appointment') }}</div>

                <div class="card-body">
                    <form method="POST" action="/patient/addAppointment">
                        @csrf
						<input id="patient_id" name="patient_id" type="hidden" value="">
                        <div class="form-group row">
                            <label for="doctor_id" class="col-md-4 col-form-label text-md-right">{{ __('Doctor:') }}</label>

                            <div class="col-md-6">
                                <select id="doctor_id" type="text" class="form-control @error('doctor_id') is-invalid @enderror" name="doctor_id">
									@foreach($doctors as $doctor)
										<option value="{{$doctor->id}}">Dr. {{$doctor->user->name}}, {{$doctor->specialization}}</option>
									@endforeach
								</select>
								@error('doctor_id')
									<div class="alert alert-danger">{{ $message }}</div>
								@enderror
                            </div>
						</div>

						<div class="form-group row">
							<label for="appointmentDate" class="col-md-4 col-form-label text-md-right">{{ __('Preferred Appointment Date:') }}</label>

							<div class="col-md-6">
							<input id="appointmentDate" type="date" min="{{Carbon\Carbon::now()->toDateString()}}" max="{{ Carbon\Carbon::now()->addDays(14)->toDateString()}}" class="form-control @error('appointmentDate') is-invalid @enderror" name="appointmentDate" autocomplete="appointmentDate">
								@error('appointmentDate')
									<div class="alert alert-danger">{{ $message }}</div>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label for="appointmentTime" class="col-md-4 col-form-label text-md-right">{{ __('Preferred Appointment Time:') }}</label>

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

						<input id="cancelled" type="hidden" class="form-control" name="cancelled" value="0" autocomplete="cancelled">


                       
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
@endsection