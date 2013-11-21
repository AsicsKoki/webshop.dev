<!doctype html>
<html>
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
		<div id="cart" >
		<div><a href="#" id="showCart" class="btn btnStyle pull-left">Open Cart</a></div></div>
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
		@yield('moreScripts')
	</body>
</html>