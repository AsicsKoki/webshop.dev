@extends('layouts/main')
@section('main')
	<div class="user-box pull-right">
		<header>Posted by </header>
		{{$product->user->username}}
	</div>
	<div class="span6">
		<h3>{{$product->name}}</h3>
		<div>
			{{Form::open(URL::route('UpdateProduct', array('pid'=>$product->id)), 'post', array('class' => 'form-horizontal pull-left'))}}
				<div class='controll-group'>
					{{Form::label('name', 'Product name :', array('class' => 'controll-lable'))}}
					<div class="controls">
						{{Form::text('name', $product->name)}}
					</div>
				</div>
				<div class='controll-group'>
					{{Form::label('price', 'Product price :', array('class' => 'controll-lable'))}}
					<div class="controls">
						{{Form::text('price', $product->price)}}
					</div>
				</div>
				<div class='controll-group'>
					{{Form::label('quantity', 'Product quantity :', array('class' => 'controll-lable'))}}
					<div class="controls">
						{{Form::text('quantity', $product->quantity)}}
					</div>
				</div>
				<div class='controll-group'>
					{{Form::label('description', 'Product description :', array('class' => 'controll-lable'))}}
					<div class="controls">
						{{Form::textarea('description', $product->description)}}
					</div>
				</div>
			{{ Form::close() }}
		</div>
	</div>
@stop