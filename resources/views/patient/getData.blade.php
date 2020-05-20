{{--% extends 'base.html' %--}}
@extends('layouts.app')
{{--% load static %--}}

@section('content')
{{--% block content %--}}
<main class="loginPage">
  {{--% include 'partials/_header.html' %--}}
  @extends('inc/_header.html')
  <form action="" method="POST" id="login-form">
      {{--% csrf_token %}
      {{--% for field in form%--}}
      @foreach ($field as form)
          
        <div class="form-group">
            
          <label>{{field->label}}</label>

          {{field}}

        </div>
        @endforeach
      {{--% endfor %--}}
        <button type="submit" class="btn btn-primary submitButton">Submit</button>
  </form>
</main>
@endsection
{{--% endblock %--}}