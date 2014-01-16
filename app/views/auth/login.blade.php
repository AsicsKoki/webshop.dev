<!doctype html>
<html>
<head>
	{{ HTML::style('css/styles.css')}}
	{{ HTML::style('css/bootstrap.min.css')}}
	{{ HTML::style('css/bootstrap-responsive.min.css')}}
</head>
@include('partials.status')
	<body id="background">
		<div id="mainElement">
		<header id="header">Konstantin's web shop</header>
			<div id="elementOne">
				<div id="central">
					<form class="form-inline" method="post">
					{{Former::text('username')->required()->label('username')->placeholder('Username')}}
					{{Former::password('password')->required()->label('password')->placeholder('Password')}}
					{{Former::hidden()->name('_token')->value(csrf_token())}}
					{{Former::actions('Sign in')->label('')->submit('Sign in')}}
					<a href="{{ URL::route('RegisterForm') }}">Register</a>
					</form>
				</div>
			</div>
			<footer id="footer">(2013) All rights reserved</footer>
		</div>
   	{{ HTML::script('js/bootstrap.js') }}
	{{ HTML::script('js/main.js') }}
</body>
</html>

