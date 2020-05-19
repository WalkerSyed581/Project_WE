@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
				<div class="card-header">{{ __('Edit/Add Ward') }}</div>
				<div class="card-body">
					<div class="appointment-content">
						<div class="appointment-text">
							<form method="POST" action="
							@if($ward)
							/helpingStaff/editWard
							@else
							/helpingStaff/addWard
							@endif">
								@csrf
								@if($ward)
								<input id="ward_id" name="ward_id" type="hidden" value={{$ward->id}}>
								@endif
								<input id="helping_staff_id" name="helping_staff_id" type="hidden" value={{$helping_staff_id}}>

								<div class="form-group row">
									<label for="capacity" class="col-md-4 col-form-label text-md-right">{{ __('Capacity:') }}</label>
		
									<div class="col-md-8">
										<input id="capacity" type="text" 
										class="form-control @error('capacity') is-invalid @enderror" 
										name="capacity"
											@if($ward)
												value="{{$ward->capacity}}"
											@endif
										
										>
										@error('capacity')
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