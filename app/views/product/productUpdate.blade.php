@extends('layouts/main')
@section('main')
	<div class="user-box pull-right">
		<header>Posted by </header>
		{{$product->user->username}}
	</div>
	<div class="span6">
		<h3>{{$product->name}}</h3>
		<div>
			{{Form::open(array('url'=>URL::route('UpdateProduct', array('pid'=>$product->id))))}}

			{{ Form::close() }}
		</div>
	</div>
@stop