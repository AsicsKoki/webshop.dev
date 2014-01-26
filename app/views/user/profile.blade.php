@extends('layouts/userLayout')
@section('main')
<div>
	<div id="data" data-userid="{{Auth::user()->id}}"></div>
	<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
		<li class="active"><a href="#profile" data-toggle="tab">Profile</a></li>
		<li><a href="#Comments" data-toggle="tab">Comments</a></li>
		<li><a href="#Posts" data-toggle="tab">Posts</a></li>
	</ul>
	<header><h4> {{$user->username}}'s profile </h4></header>
	<div id="my-tab-content" class="tab-content">
		<div class="tab-pane active" id="profile">
			<div class="columnLeft">
				<ul class="plain">
				@foreach ($user->images as $image) {
					<li><img src="files/{{$image->path}}"></img></li>
				}
				@endforeach
				</ul>
			</div>
			<div class="columnRight" ng-app ng-controller="profileController" ng-include="tpl='{{URL::to('/')}}/templates/partials/profileInfo.html'">
				Loading...
			</div>
		</div>
		<div ng-app class="tab-pane" id="Comments" ng-controller="profileController" ng-include="tpl='{{URL::to('/')}}/templates/partials/commentList.html'">
			Loading...
		</div>
		<div class="tab-pane" id="Posts" ng-app ng-controller="profileController" ng-include="tpl='{{URL::to('/')}}/templates/partials/profileProductList.html'">
		Loading...
		</div>
	</div>
</div>
@stop
@section('moreScripts')
{{ HTML::script('js/angularScripts.js') }}
@stop