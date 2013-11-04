@extends('layouts/newItemLayout')
@section('main')
	<div class="span6">
		<div>
			{{ Former::open()->class('form-horizontal pull-left')->method('put')->enctype('multipart/form-data')->action(URL::route('putNewProduct'))}}
			<div class='control-group'>
				{{ Former::text('name')->required()->label('name')->maxlength(50) }}
			</div>
			<div class='control-group'>
				{{ Former::textarea('description')->required()->label('description')->maxlength(500) }}
			</div>
			<div class='control-group'>
				{{ Former::number('price')->required()->label('price') }}
			</div>
			<div class='control-group'>
				{{ Former::number('quantity')->required()->label('quantity') }}
			</div>
			<div class='control-group'>
				{{Former::select('color_id')->options(['1'=>'Red', '2'=>'Green','3'=>'Blue','4'=>'Purple'])}}
			</div>
				{{Former::hidden()->name('_token')->value(csrf_token())}}
				{{Former::actions()->submit('Submit')}}
			{{ Former::close() }}
		</div>
	</div>
@stop