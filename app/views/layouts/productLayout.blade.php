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
		{{ HTML::script('js/jquery.flexslider-min.js') }}
		<script type="text/javascript" charset="utf-8">
        $(window).load(function() {
            $('.flexslider').flexslider();
        });
        </script>
    @stop
</html>