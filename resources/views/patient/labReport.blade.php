@extends('layouts.app')
@section('content')
<article class="lab-test">
    <div class="row">
        <div class="col-md-3 bg-dark" >
            <h1 class="text-center position-fixed" style="color:white">Mr. {{Auth::user()->name}}</h1>
            @include('patient.aside')
        </div> 
    <div class="card-body lab-report col-md-9">
            {!! $labReport->report_text !!}
            <button class="btn btn-primary download-report">Download PDF</button>
    </div>
   
</article>
@endsection
