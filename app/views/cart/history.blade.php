@extends('layouts/main')
@section('main')
	<div id="data" data-userid="{{Auth::user()->id}}"></div>
	<div  id="orderlist" ng-app ng-controller="orderController" ng-include="tpl='{{URL::to('/')}}/templates/partials/orders.html'">
	123
	</div>
@stop