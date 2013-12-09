@extends('layouts/productLayout')
@section('main')
@include('partials/categoryMenu')
	<div class="user-box pull-right">
		<header>Posted by </header>
		{{$product->user->username}}
	</div>
	<div class="span 4">
		<div class="flexslider">
			<ul class="slides">
			@foreach ($product->images as $image)
				<li><img src="/img/{{$image->path}}"/></li>
			@endforeach
			</ul>
		</div>
		@include('partials/rating')
		@foreach ($product->comments as $comment)
		<div class="commentBox well">
		  <header class="com_header">
			<a href="/user/{{$comment['user_id']}}">{{$comment->user->username}}</a>
			</header>
			{{$comment['comment']}}
		</div>
		@endforeach
	</div>
	<div class="span6">
		<h3>{{$product->name}}</h3>
		<div>
			<dl class="dl-horizontal">
				<dt>Description:</dt>
				<dd class='text-left'> {{$product->description}}<button id="readMore">Read more</button> </dd>
				<div id="more" class="hide">
					Lorem ipsum enim aliquip in et nulla deserunt esse anim ullamco officia proident id reprehenderit sint exercitation tempor amet in enim culpa.
				</div>
				<dt>Price:</dt>
				<dd class='text-left'>{{$product->price}}</dd>
				<dt>In stock:</dt>
				<dd class='text-left'>{{$product->quantity}}</dd>
			</dl>
		{{ Former::open()->class('form-horizontal pull-left')->method('post')->enctype('multipart/form-data')}}
			{{ Former::select('color_id')->label('Color')->options(['1'=>'Red', '2'=>'Green','3'=>'Blue','4'=>'Purple'])}}
			{{ Former::number('quantity')->required()->label('quantity') }}
			{{ Former::hidden()->name('_token')->value(csrf_token()) }}
			{{ Former::framework('Nude') }}
			{{ Former::actions()->submit('Submit') }}
		{{ Former::close() }}
		</div>
		<form id="post_comment_form" action="">
			<textarea required="required" data-minlength="6" id="comment" name="comment" cols="100" rows="10"></textarea>
			<input data-id="{{$product->id}}" id="post_comment" type="submit" name"submit" class="btn" value="Comment">
		</form>
	</div>
@stop
@section('moreScripts')
<script type="text/javascript">
	$('.ratings_stars').hover(
	// Handles the mouseover
	function() {
		$(this).prevAll().andSelf().addClass('ratings_over');
		$(this).nextAll().removeClass('ratings_vote');
	},
	// Handles the mouseout
	function() {
		if($('#r1').data('rated')== 1 ){
			return 0;
		}
		$(this).prevAll().andSelf().removeClass('ratings_over');
		}
	);
</script>
<script type="text/javascript">
	//Rating stars controll
	$('div#r1').children('div.ratings_stars').click(function(){
		var rating = $(this).index();
		var rating = rating + 1;
		var userid = $(this).data('userid');
		var productid = $(this).data('productid');
		var self = this;
		$.ajax({
			url: "rate",
			type: "POST",
			data: {
				rating: rating,
				user_id: userid,
				product_id: productid
			},
		success: function(data){
			if (data){
				$("#r1").data('rated','1');
				$(self).prevAll().andSelf().addClass('ratings_over');
				}
			}
		});
	});

</script>
<script type="text/javascript">
$('input#post_comment').click(function(e){
	e.preventDefault();
	var text = $('textarea#comment').val();
	var id = $(this).data('id');
	var self = this;
		$.ajax({
			url: "comment",
			type: "POST",
			data: {
				id: id,
				text: text
			},
		success: function(data){
			if (data){

			}
		}
	});
});
</script>
@stop