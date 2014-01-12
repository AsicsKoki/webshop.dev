@extends('layouts/newItemLayout')
@section('main')
	<div class="span6">
		<div>
			{{ Former::open()->rules(array(
				'name'     => 'required|max:50',
				'description' => 'required|max:500',
				'price'    => 'number',
				'quantity' => 'number|int',
				'avatar'   => 'image',))->class('form-horizontal pull-left')->method('put')->enctype('multipart/form-data')->action(URL::route('putNewProduct'))}}
			<div class='control-group'>
				{{ Former::text('name')->required()->label('name') }}
			</div>
			<div class='control-group'>
				{{ Former::textarea('description')->required()->label('description') }}
			</div>
			<div class='control-group'>
				{{ Former::number('price')->required()->label('price') }}
			</div>
			<div class='control-group'>
				{{ Former::number('quantity')->required()->label('quantity') }}
			</div>
			<div class='control-group'>
				{{Former::select('color_id')->label('Color')->options(['1'=>'Red', '2'=>'Green','3'=>'Blue','4'=>'Purple'])}}
			</div>
			<div class='control-group'>
				{{ Former::file('image')->label('Image') }}
			</div>
				{{Former::hidden()->name('_token')->value(csrf_token())}}
				{{Former::actions()->submit('Submit')}}
			{{ Former::close() }}
		</div>
	</div>
@stop