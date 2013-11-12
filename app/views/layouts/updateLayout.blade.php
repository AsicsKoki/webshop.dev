<!doctype html>
<html>
	<head>
		{{-- STYLES --}}
		{{HTML::style('css/styles.css')}}
		{{HTML::style('css/bootstrap.min.css')}}
		{{HTML::style('css/bootstrap-responsive.min.css')}}
		{{HTML::style('css/flexslider.css')}}
	</head>
	<body id="background">
		<div id="mainElement">
		@include('partials.status')
		<header id="header">
			<p>Konstantin's web shop</p>
		</header>
			@include('partials.loginLogout')
			@include('partials.navbar')
			@yield('main')
			<footer id="footer">(2013) All rights reserved</footer>
		</div>
		{{-- SCRIPTS --}}
		{{ HTML::script('js/jquery-1.10.2.min.js') }}
		{{ HTML::script('js/jquery.dataTables.js') }}
		{{ HTML::script('js/main.js') }}
		{{ HTML::script('js/bootstrap.js') }}
		{{ HTML::script('js/parsley.js') }}
		{{ HTML::script('js/jquery.flexslider-min.js') }}
	</body>
</html>