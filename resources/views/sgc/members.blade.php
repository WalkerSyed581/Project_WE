@extends('layouts.app')
@section('content')
<div class="docHeader">
    <h1>Mr. {{Auth::user()->name}}'s Dashboard</h1>
</div>
<div class="mainContent docContent">
    <article>
		<h2>Members of Support Group: {{$supportGroup->name}}</h2>
        <section class="cards upcoming-appointments">
            @if($patients)
            @foreach($patients as $patient)
                <div class="card appointment">
					<h3>Patient Name: {{$patient->user->name}}</h3>
					<div class="appointment-content">
						<div class="appointment-text">
							<p>Gender:
								@if($patient->user->gender=='f')
								 Female
								@elseif($patient->user->gender=='m')
								 Male
								@endif
							</p>
							<p>Age: {{$patient->user->age}}</p>
							<p>Email: {{$patient->user->email}}</p>
						</div>
					</div>
                </div>
                @endforeach
            @else
                <p>No members of this support group</p>
            @endif
        </section>
    </article>
</div>
@endsection
