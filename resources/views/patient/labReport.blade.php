@extends('layouts.app')
@section('content')
<article class="lab-test">
    <div class="lab-report">
            {!! $labReport->report_text !!}
    </div>
    <button class="btn btn-danger download-report">Download PDF</button>
</article>
@endsection
