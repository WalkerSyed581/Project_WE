@extends('layouts.app')
@section('content')
<div class="docHeader">
    <h1>Mr. {{Auth::user()->name}}'s Dashboard</h1>
</div>
<div class="mainContent docContent">
    <article>
		<h2>Support Groups</h2>
        <section class="cards upcoming-appointments">
            @if($supportGroups)
            @foreach($supportGroups as $supportGroup)
                <div class="card appointment">
					<h3>Support Group: {{$supportGroup->name}}</h3>
					<div class="appointment-content">
						<div class="appointment-text">
							<p>Day: {{$supportGroup->day}}</p>
							<span>Time and Date: {{$supportGroup->timing}}</span>
							<p>Description: {{$supportGroup->description}}</p>
						</div>
					</div>
                </div>
                @endforeach
            @else
                <p>You have not conducting any Support Group</p>
            @endif
        </section>
    </article>
</div>
@endsection
