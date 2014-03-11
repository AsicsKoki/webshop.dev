@extends('layouts/main')
@section('main')
	<div data-userid="{{Auth::User()->id}}" id="orderList" ng-app ng-controller="orderController" ng-include="tpl='{{URL::to('/')}}/templates/partials/orders.html'">
	123
	</div>
@stop