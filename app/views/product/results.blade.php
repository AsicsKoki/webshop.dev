@extends('layouts/mainLayout')
	@section('moreStyles')
		{{HTML::style('css/bootstrap-responsive.min.css')}}
	@stop
	@section('main')
	@foreach ($data as $product)
		<div class="resThumb">
			<div class="thumbnail pull-left" style="width: 300px;">
				@if($product->images()->take(1)->get()->first())
					<img src="files/{{$product->images()->take(1)->get()->first()->path}}" alt="">
				@endif
				<h3>{{$product->name}}</h3>
				<p>{{$product->description}}</p>
				{{ HTML::route('ShowProductPage', 'Read more', array('pid'=>$product->id), array('class'=>'btn')) }}
			</div>
		</div>
	@endforeach
	@stop