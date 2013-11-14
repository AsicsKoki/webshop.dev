@extends('layouts/mainLayout')
	@section('moreStyles')
		{{HTML::style('css/bootstrap-responsive.min.css')}}
	@stop
	@section('main')
	@foreach ($data as $resault) {
		<div class="resThumb">
			<div class="thumbnail pull-left" style="width: 300px;">
				<img src="files/{{$data->image->path}}" alt="">
				<h3>{{$data->name}}</h3>
				<p>{{$data->description}}</p>
				{{ HTML::route('ShowProductPage', 'Read more', array('pid'=>$data->id), array('class'=>'btn')) }}
			</div>
		</div>
	@endforeach
	@stop