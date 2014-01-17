@extends('layouts/mainLayout')
@section('moreStyles')
	{{-- STYLES --}}
	{{HTML::style('css/bootstrap-responsive.min.css')}}
	{{HTML::style('css/flexslider.css')}}
@stop
@section('moreSctipts')
	{{-- SCRIPTS --}}
	{{ HTML::script('js/jquery.dataTables.js') }}
	{{ HTML::script('js/parsley.js') }}
	{{ HTML::script('https://ajax.googleapis.com/ajax/libs/angularjs/1.2.9/angular.min.js') }}
@stop
