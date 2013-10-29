<!doctype html>
<html>
	<head>
		{{-- STYLES --}}
		{{HTML::style('css/styles.css')}}
		{{HTML::style('css/bootstrap.min.css')}}
		{{HTML::style('css/bootstrap-responsive.min.css')}}
		{{HTML::style('css/jquery.dataTables.css')}}
		{{HTML::style('css/jquery.dataTables_themeroller.css')}}
		{{ HTML::script('js/jquery-1.10.2.min.js') }}
	</head>
	<body id="background">
		<div id="mainElement">
		<header id="header">
			<p>Konstantin's web shop</p>
		</header>
			@include('partials.loginLogout')
			@include('partials.navbar')
			@yield('main')
			<footer id="footer">(2013) All rights reserved</footer>
		</div>
		{{-- SCRIPTS --}}
		{{ HTML::script('js/bootstrap.js') }}
		{{ HTML::script('js/jquery.dataTables.js') }}
		{{ HTML::script('js/main.js') }}
	</body>
</html>