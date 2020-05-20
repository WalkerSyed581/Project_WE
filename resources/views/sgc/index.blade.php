@extends('layouts.app')
@section('content')
<div class="docHeader container-fluid ">
    <div class="row">
    <div class="col-md-3" >{{Auth::user()->name}}</h1>
    </div>
<div class="mainContent docContent col-md-9">
    <article>
		<h2>Support Groups</h2>
        <section class="upcoming-appointments">
            @if($supportGroups)
            <table class="table">
                <tr>
                    <th>Support Group</th>
                    <th>Day</th>
                    <th>ime and Date</th>
                    <th>Description</th>
                </tr>
            @foreach($supportGroups as $supportGroup)
            <tr>
                <td>{{$supportGroup->name}}</td>
                <td>{{$supportGroup->day}}</td>
                <td>{{$supportGroup->timing}}</td>
                <td>{{$supportGroup->description}}</td>
            </tr>
        
                
                @endforeach
                </table>
            @else
                <p>You have not conducting any Support Group</p>
            @endif
        </section>
    </article>
</div>
</div>
</div>
@endsection
