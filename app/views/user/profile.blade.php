@extends('layouts/userLayout')
@section('main')
<div>
	<div id="data" data-userid="{{Auth::user()->id}}" data-roleid="{{Auth::user()->role_id}}"></div>
	<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
		<li class="active"><a href="#profile" data-toggle="tab">Profile</a></li>
		<li><a href="#Comments" data-toggle="tab">Comments</a></li>
		<li><a href="#Posts" data-toggle="tab">Posts</a></li>
	</ul>
	<header><h4> {{$user->username}}'s profile </h4></header>
	<div id="my-tab-content" class="tab-content" ng-app ng-controller="profileController" >
		<div class="tab-pane active" id="profile">
			<div class="columnLeft">
				<div ng-include="tpl='{{URL::to('/')}}/templates/partials/profileReviews.html'">
					Loading...
				</div>
			</div>
			<div class="columnRight" ng-include="tpl='{{URL::to('/')}}/templates/partials/profileInfo.html'">
				Loading...
			</div>
		</div>
		<div class="tab-pane" id="Comments" ng-include="tpl='{{URL::to('/')}}/templates/partials/commentList.html'">
			Loading...
		</div>
		<div class="tab-pane" id="Posts" ng-include="tpl='{{URL::to('/')}}/templates/partials/profileProductsList.html'">
		Loading...
		</div>
	</div>
</div>
@stop
@section('moreScripts')
{{ HTML::script('js/angularScripts.js') }}
@stop