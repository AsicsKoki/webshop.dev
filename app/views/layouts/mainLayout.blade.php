<!doctype html>
<html ng-app="webshop">
	<head>
		{{-- STYLES --}}
		{{HTML::style('css/styles.css')}}
		{{HTML::style('css/bootstrap.min.css')}}
		@yield('moreStyles')
	</head>
	<body id="background">
		@include('partials.status')
		<div id="mainElement">
		<header id="header">
			@include('partials.cart')
			<p>Konstantin's web shop</p>
		</header>
		@include('partials.loginLogout')
		@include('partials.navbar')
			@yield('main')
		<footer id="footer">(2013) All rights reserved</footer>
		</div>
		{{-- SCRIPTS --}}
		{{ HTML::script('js/jquery-1.10.2.min.js') }}
		{{ HTML::script('js/main.js') }}
		{{ HTML::script('js/bootstrap.js') }}
		{{ HTML::script('https://ajax.googleapis.com/ajax/libs/angularjs/1.2.9/angular.min.js') }}
		{{ HTML::script('js/angularScripts.js') }}
		@yield('moreScripts')
	</body>
</html>