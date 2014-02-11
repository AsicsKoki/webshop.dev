@extends('layouts/productLayout')
@section('moreStyles')
	{{-- STYLES --}}
	{{HTML::style('css/contact.css')}}
@stop
@section('main')
@include('partials/categoryMenu')
	<div id="contactForm" ng-app ng-controller="contactController" ng-include="tpl='{{URL::to('/')}}/templates/partials/contact.html'">
	123
	</div>
@stop
@section('moreScripts')
{{ HTML::script('js/jquery.flexslider-min.js') }}
{{ HTML::script('js/angularScripts.js') }}
@stop