<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<base href="/">
		<title>{{ config('app.name') }}</title>
		<meta charset="UTF-8">

		{{-- Kad pravis ajax post requeste, content ovog taga trebas slati kao post parametar pod nazivom _token --}}
		<meta id="the-t" content="{{ csrf_token() }}">

		<link rel="shortcut icon" type="image/png" href="{{ favicon() }}"/>

		@include ('layouts.styles')
		
		@yield ('css')
	</head>

	<body>
		@include ('admin.header')

		<div class="page-content">
			@yield ('content')
		</div>

		@include ('layouts.scripts')
		<script src="{{ getTheme() }}/js/admin/header.js"></script>
		@yield ('scripts')
	</body>
</html>