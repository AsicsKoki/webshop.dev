@extends('layouts/userLayout')
@section('main')
<div>
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
			<div class="columnRight">
				<ul class="plain">
					<li><h4>First name:</h4> {{$user->first_name}}</li>
					<li><h4>Last name:</h4> {{$user->last_name}}</li>
					<li><h4>Email:</h4> {{$user->email}} </li>
					<li><h4>About me:</h4>{{$user->bio}}</li>
				</ul>
			</div>
		</div>
		<div class="tab-pane" id="Comments">
			<table id="like_table" class="table table-hover display">
				<thead>
					<th>Comment</th>
					<th>Action</th>
				</thead>
				<tbody>
				@foreach ($user->comments as $comment)
					<tr>
						<td>{{$comment['comment']}}</td>
						<td><a href="#" class="deleteComment" data-commentid="{{$comment['id']}}">Delete</a></td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
		<div class="tab-pane" id="Posts">
		<table id="productsTable" class="table table-hover display dataTable">
		<thead>
			<th>Product name</th>
			<th>Color</th>
			<th>Price</th>
			<th>Action</th>
			<th>Quantity</th>
		</thead>
		<tbody>
		@foreach($user->products as $product)
			<tr>
				<td>{{$product->name}}</td>
				<td>{{$product->color->color_name}}</td>
				<td>{{$product->price}}</td>
				<td>{{ HTML::route('ShowProductPage', 'Read more', array('pid'=>$product->id), array('class'=>'btn')) }}</td>
				<td>{{$product->quantity}}</td>
			</tr>
		@endforeach
		</tbody>
	</table>
		</div>
	</div>
</div>
@stop
@section('moreScripts')
<script type="text/javascript">
$('.deleteComment').click(function(e){
	e.preventDefault();
	var id = $(this).data('commentid');
	var self = this;
	$.ajax({
		url: "deleteComment",
		type: "DELETE",
		data: {
			id: id
		},
		success: function(data){
			if (data){
				$(self).parents("tr").remove();
			}
		}
	});
});
</script>
@stop