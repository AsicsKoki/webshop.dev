@extends('layouts/mainLayout')
	@section('moreStyles')
		{{-- STYLES --}}
		{{HTML::style('css/styles.css')}}
		{{HTML::style('css/bootstrap.min.css')}}
		{{HTML::style('css/bootstrap-responsive.min.css')}}
		{{HTML::style('css/flexslider.css')}}
	@stop
	@section('moreScripts')
		{{-- SCRIPTS --}}
		{{ HTML::script('js/jquery.dataTables.js') }}
		{{ HTML::script('js/parsley.js') }}
		{{ HTML::script('js/jquery.flexslider-min.js') }}
	@stop