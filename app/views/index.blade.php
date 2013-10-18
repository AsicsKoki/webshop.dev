@extends('master')

@section('container')
	{{ Form::open(array('/')) }}
		{{Form::text('text')}}
		{{Form::submit('Shorten!')}}
	{{ Form::close() }}
@stop