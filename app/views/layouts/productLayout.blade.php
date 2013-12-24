@extends('layouts/mainLayout')
<html>
	@section('moreStyles')
		{{-- STYLES --}}
		{{HTML::style('css/bootstrap-responsive.min.css')}}
		{{HTML::style('css/flexslider.css')}}
	@stop
	@section('moreSctipts')
		{{-- SCRIPTS --}}
		{{ HTML::script('js/jquery.dataTables.js') }}
		{{ HTML::script('js/parsley.js') }}
    @stop
</html>