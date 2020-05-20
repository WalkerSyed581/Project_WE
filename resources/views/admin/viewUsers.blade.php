@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register New Patient') }}</div>

                <div class="card-body">
					<table>
						<tr>
							<th>Name</th>
							<th>Email</th>
							<th>Gender</th>
							<th>Phone</th>
							<th>Cnic</th>
							<th>Age</th>
							<th>Role</th>
							<th>Edit Role Data</th>
						</tr>
						@foreach($users as users)
							<tr>
								<td>{{$user->name}}</td>
								<td>{{$user->email}}</td>
								<td>
									@if($user->gender == 'f')
										Female
									@else
										Male
									@endif
								</td>
								<td>{{$user->phone}}</td>
								<td>{{$user->cnic}}</td>
								<td>{{$user->age}}</td>
								<td>{{$user->role}}</td>
								<td><a class="btn btn-danger" href="{{action('AdminController@showRoleForm',['id'=>\Auth::id(),'user_id'=>$user->id,'role'=>$user->role])}}">Edit</a>
							</tr>
						@endforeach
					</table>
				</div>
            </div>
        </div>
    </div>
</div>
@endsection
