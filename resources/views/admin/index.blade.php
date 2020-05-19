@extends('layouts.app')

@section('content')
	<a href="{{action('AdminController@showRegisterForm',['id'=>\Auth::id()])}}">Register User</a>
@endsection

