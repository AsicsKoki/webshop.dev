@extends('layouts/mainLayout')
@section('moreStyles')
	{{-- STYLES --}}
	{{HTML::style('css/bootstrap-responsive.min.css')}}
	{{HTML::style('css/jquery.dataTables.css')}}
	{{HTML::style('css/jquery.dataTables_themeroller.css')}}
@stop
@section('moreScripts')
	{{-- SCRIPTS --}}
	{{ HTML::script('js/jquery.dataTables.js') }}
<script type="text/javascript">
	if($('.dataTable').length){
		$(document).ready(function() {
			$('.dataTable').dataTable();
		});
	}
</script>
@stop