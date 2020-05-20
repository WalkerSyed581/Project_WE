@extends('layouts.app')

@section('content')
<div class="container-fluid ">
    <div class="row">
    <div class="col-md-3 bg-dark" >
        <h1 class="text-center " style="color:white">{{Auth::user()->name}}</h1>
       <aside class="col-md-3 p-0 flex-shrink-1 sticky-top" style="margin-top:30px">
            <!--fixed-top/sticky-top-->
            <nav class="navbar navbar-expand navbar-dark  flex-md-column flex-row align-items-start py-2">
                <div class="collapse navbar-collapse">
                    <ul class="flex-md-column flex-row navbar-nav w-100 justify-content-between ">
                        
                        <li class="nav-item">
                            <a class="nav-link pl-0" href=" /Project_WE/public/helpingStaff/addLabReport"><i class="fa fa-book fa-fw"></i> <span class="d-none d-md-inline"></span>Add Lab Report</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-0" href="/Project_WE/public/helpingStaff/{id}/addTest"><i class="fa fa-cog fa-fw"></i> <span class="d-none d-md-inline">Add Lab Test</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-0" href=" /Project_WE/public/helpingStaff/{id}/labAppointment/{labAppointment_id}"><i class="fa fa-heart codeply fa-fw"></i> <span class="d-none d-md-inline">Show Lab Appointment</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-0" href=" /Project_WE/public/helpingStaff/{id}/addWard"><i class="fa fa-heart codeply fa-fw"></i> <span class="d-none d-md-inline">Add Ward</span></a>
                        </li>
                       
                        
                    </ul>
                </div>
            </nav>
        </aside>
    </div> 
    
    <div class="card col-md-9" >
    <div class="card-body">
        <div>
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
</div>
</div>
@endsection