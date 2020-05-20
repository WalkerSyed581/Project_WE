@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
					<div class="card-header">{{ __('Add Drugs') }}</div>
					<div class="card-body">
						<div class="appointment-content">
							<div class="appointment-text">
								<form method="POST" action="/doctor/addDrugs">
									@csrf
									<input id="prescription_id" name="prescription_id" type="hidden" value={{$prescription_id}}>
									<input id="number_of_drugs" name="number_of_drugs" type="hidden" value={{$noOfDrugs}}>
									<input id="doctor_id" name="doctor_id" type="hidden" value={{$doctor_id}}>

									@for($i=0; $i < $noOfDrugs;$i++)
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="drugName">Drug Name</label>
												<input type="text" class="form-control drugName" name="drugName{{$i}}">
												@error('drugName{{$i}}')
													<div class="alert alert-danger">{{ $message }}</div>
												@enderror
											</div>
											<div class="form-group col-md-6">
												<label for="dose">Dose</label>
												<input type="text" class="form-control dose" name="dose{{$i}}">
												@error('dose{{$i}}')
													<div class="alert alert-danger">{{ $message }}</div>
												@enderror
											</div>
										</div>
									@endfor
									
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