<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<base href="/">
		<title>{{ pageTitle() }}</title>
		<meta charset="UTF-8">

		{{-- Kad pravis ajax post requeste, content ovog taga trebas slati kao post parametar pod nazivom _token --}}
		<meta id="the-t" content="{{ csrf_token() }}">

		<link rel="icon" href="{{ favicon() }}" type="image/png" sizes="32x32">

		@include ('layouts.styles')
		
		@yield ('css')
	</head>

	<body>
		@yield ('content')

		<footer class="login-footer">
			{!! \App\Packages\System\Versionist::copyrightText() !!}
		</footer>

		@include ('layouts.scripts')
		@yield ('scripts')
	</body>
</html>