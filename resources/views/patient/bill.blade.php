{{--% extends 'base.html' %--}}
@extends('layouts.app')
@section('content')
{{--% block content %--}}
{{--% include 'partials/_header.html' %--}}
@extends('inc/_header.html')
<div class="patientPage billPage">
    <div class="patientHeader">
        <h1>{{patient->first_name}}  {{patient->last_name}}'s Dashboard</h1>
    </div>
    <article class="content billContent">
        <p>Patient's Name : {{patient->first_name}}  {{patient->last_name}}</p>
        <p>Payment Method : Cash</p>
        <p>Payment Status : Unpaid/Remaining/Paid</p>
        <ul id="fees">
            <li class="doctor-fee">
                Total fee of all appointments: {{fees->doctorFee}} 
            </li>
            <li class="room-fee">
                Ward Fee: {{fees->wardFee}} 
            </li>
            <li>
                Total Fee of Support Groups: {{feportGroes->supupFee}}
            </li>
            <li class="dropright">
                <a href="#" class= "dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Total Fee of Lab Tests: {{fees.totalTestFee}}</a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    {% for name,fee in fees->testFees->values() %}
                        <li class="dropdown-item">{{name}} : {{fee}}</li>
                    {% endfor %}
                </ul>
            </li>
            <li class="total-fee">
                Total: {{fees->totalFee}}
            </li>
        </ul>
    </article>
</div>
@endsection
{{--% endblock %--}}