@extends('layouts.app')

@section('content')
<div class="container-fluid col-md-12">
	<div class="row">
		@include('inc.aside')
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">{{ __('Edit Users') }}</div>

                <div class="card-body">
					<table class="table">
						<tr>
							<th scope="col">Name</th>
							<th scope="col">Email</th>
							<th scope="col">Gender</th>
							<th scope="col">Phone</th>
							<th scope="col">Cnic</th>
							<th scope="col">Age</th>
							<th scope="col">Role</th>
							<th scope="col">Edit Role Data</th>
						</tr>
						@foreach($users as $user)
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
