{{--% extends 'base.html' %--}}
@extends('layouts.app')
{{--% block content %--}}
@section('content')
{{--% include 'partials/_header.html' %--}}
@extends('inc/_header.html')
<article class="lab-test">
    <div class="lab-report">
        {{--% autoescape off %--}}
            {{ labReports->text|safe }}
        {{--% endautoescape %--}}
    </div>
    <button class="btn btn-danger download-report">Download PDF</button>
</article>
@endsection
{{--% endblock %--}}