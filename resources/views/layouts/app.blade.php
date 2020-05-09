<!DOCTYPE html>
<html lang="{{config('app.locale')}}">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{{config('app.name','HealthCare')}}</title>
	<link href="{{asset('css/app.css')}}" rel="stylesheet">
	
</head>
<body>
	@yield('content')
</html>
