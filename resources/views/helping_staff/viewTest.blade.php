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
							@if($test)
							/helpingStaff/editTest
							@else
							/helpingStaff/addTest
							@endif">
								@csrf
								
								@if($test)
								<input id="test_id" name="test_id" type="hidden" value={{$test->id}}>
								@endif
								<input id="helping_staff_id" name="helping_staff_id" type="hidden" value={{$helping_staff_id}}>

								<div class="form-group row">
									<label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name of Test:') }}</label>
		
									<div class="col-md-8">
										<input id="name" type="text" 
										class="form-control @error('name') is-invalid @enderror" 
										name="name"
											@if($test)
												value="{{$test->name}}"
											@endif
										
										>
										@error('name')
											<div class="alert alert-danger">{{ $message }}</div>
										@enderror
									</div>
								</div>

								<div class="form-group row">
									<label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description of Test:') }}</label>
		
									<div class="col-md-8">
										<textarea id="description" rows="5" cols="20"
										class="form-control @error('description') is-invalid @enderror" 
										name="description">
										@if($test)
												{{$test->description}}
										@endif
										</textarea>
										@error('description')
											<div class="alert alert-danger">{{ $message }}</div>
										@enderror
									</div>
								</div>

								<div class="form-group row">
									<label for="fee" class="col-md-4 col-form-label text-md-right">{{ __('Fee:') }}</label>
		
									<div class="col-md-8">
										<input id="fee" type="text"
										class="form-control @error('fee') is-invalid @enderror" 
										name="fee"
										@if($test)
												value="{{$test->fee}}"
										@endif>
										
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
	</div>
</div>
@endsection