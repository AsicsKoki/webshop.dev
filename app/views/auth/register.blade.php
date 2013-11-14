<!doctype html>
<html>
<head>
@include('partials.status')
	{{ HTML::style('css/styles.css')}}
	{{ HTML::style('css/bootstrap.min.css')}}
	{{ HTML::style('css/bootstrap-responsive.min.css')}}
</head>
	<body id="background">
		<div id="mainElement">
		<header id="header">Konstantin's web shop</header>
			<div id="elementOne">
				<div id="central">
				{{ Former::open()->class('form-horizontal pull-left')->method('PUT')->enctype('multipart/form-data')->action(URL::route('PutNewUser'))}}
					{{Former::text('username')->required()->label('username')->placeholder('Username')}}
					{{Former::password('password')->required()->label('password')->placeholder('Password')}}
					{{Former::password('password_confirmation')->required()->label('password')->placeholder('Retype your password')}}
					{{Former::text('first_name')->required()->label('First Name')->placeholder('Enter First Name')}}
					{{Former::text('last_name')->required()->label('Last Name')->placeholder('Enter Last Name')}}
					{{Former::email('email')->required()->label('Email')->placeholder('Enter Your Email')}}
					{{Former::hidden()->name('_token')->value(csrf_token())}}
					{{Former::submit('Register')}}
				{{ Former::close() }}
				</div>
			</div>
			<footer id="footer">(2013) All rights reserved</footer>
		</div>
   	{{ HTML::script('js/bootstrap.js') }}
	{{ HTML::script('js/main.js') }}
</body>
</html>

