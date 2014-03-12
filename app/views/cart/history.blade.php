@extends('layouts/main')
@section('main')
	<div id="data" ></div>
	<div data-userid="{{Auth::user()->id}}" id="orderlist" ng-app ng-controller="orderController" ng-include="tpl='{{URL::to('/')}}/templates/partials/orders.html'">
	123
	</div>
@stop