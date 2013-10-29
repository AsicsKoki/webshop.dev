@extends('layouts/userLayout')
@section('main')
<div>
	<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
		<li class="active"><a href="#profile" data-toggle="tab">Profile</a></li>
		<li><a href="#likes" data-toggle="tab">Likes</a></li>
		<li><a href="#rates" data-toggle="tab">Ratings</a></li>
		<li><a href="#Posts" data-toggle="tab">Posts</a></li>
	</ul>
	<header><h4> {{$user->username}}'s profile </h4></header>
	<div id="my-tab-content" class="tab-content">
		 <div class="tab-pane active" id="profile">
			<div class="columnLeft">
				#Here goes profile pic
			</div>
			<div class="columnRight">
				<ul class="plain">
					<li><h4>First name:</h4> {{$user->first_name}}</li>
					<li><h4>Last name:</h4> {{$user->last_name}}</li>
					<li><h4>Email:</h4> {{$user->email}} </li>
					<li><h4>About me:</h4>{{$user->bio}}</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="tab-pane" id="likes">
		<table id="like_table" class="table table-hover display">
				<thead>
						<th>Comment id</th>
						<th>Posted by</th>
						<th>Comment</th>
						<th>Delete like</th>
				</thead>
				<tbody>
					#HERE GO LIKES
				</tbody>
		</table>
	</div>
</div>
@stop