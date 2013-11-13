@extends('layouts/mainLayout')
<html>
	@section('moreStyles')
		{{-- STYLES --}}
		{{ HTML::style('css/bootstrap-responsive.min.css')}}
		{{ HTML::style('css/jquery.dataTables.css')}}
		{{ HTML::style('css/jquery.dataTables.css')}}
	@stop
	@section('moreScripts')
		{{-- SCRIPTS --}}
		{{ HTML::script('js/jquery.dataTables.js') }}
	@stop
</html>