@extends('layouts/main')
@section('main')
	<div class="user-box pull-right">
		<header>Posted by </header>
		{{$product->user->username}}
	</div>
	<div class="span6">
		<h3>{{$product->name}}</h3>
		<div>
			{{ Former::open()->class('form-horizontal pull-left')->method('POST')->enctype('multipart/form-data')->action(URL::route('UpdateProduct', array('pid'=>$product->id)))}}
			<div class='control-group'>
				{{ Former::text('name')->required()->label('name')->maxlength(50)->value($product->name) }}
			</div>
			<div class='control-group'>
				{{ Former::textarea('description')->required()->label('description')->maxlength(500)->value($product->description) }}
			</div>
			<div class='control-group'>
				{{ Former::number('price')->required()->label('price')->value($product->price) }}
			</div>
			<div class='control-group'>
				{{ Former::number('quantity')->required()->label('quantity')->value($product->quantity) }}
			</div>
				{{Former::actions()->submit('Submit')}}
			{{ Former::close() }}
		</div>
	</div>
@stop