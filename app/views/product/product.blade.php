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
			@if(!$product->images->isEmpty())
				@foreach ($product->images as $image)
					<li><img class="imgThumb" src="/img/{{$image->path}}"/></li>
				@endforeach
			@else
				<li><img class="imgThumb" src="/img/default.gif"/></li>
			@endif
			</ul>
		</div>
		@include('partials/rating')
			<div id="data" class="hide" data-productid="{{$product->id}}" data-userrole="{{Auth::user()->role_id}}" data-userid="{{Auth::user()->id}}"></div>
			<div id="commentArea"  ng-controller="commentAreaController" ng-include="tpl='{{URL::to('/')}}/templates/partials/productComments.html'">
				<div id="spin"><div></div></div>
			</div>
		@if(Auth::user()->role_id == 1)
			<div id="categorySelect">
	     		<ul style='list-style: none; text-align: left;'>
	     		<h4>Please select item category:</h4>
	     		{{Utils\HtmlGenerator::renderCategorySelection(0,0, $product->id)}}
	     		</ul>
			</div>
		@endif
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
			{{ Former::number('quantity')->required()->label('quantity')->class('quantityArea')->pattern('[0-9]*') }}
			{{ Former::hidden()->name('_token')->value(csrf_token()) }}
			{{ Former::framework('Nude') }}
			@if($product->quantity > 0)
				{{ Former::actions()->submit('Add to cart') }}
			@else
				<a href="#" class="btn-danger">Sold out!</a>'}}
			@endif
		{{ Former::close() }}
		</div>
		<form id="post_comment_form" action="">
			<textarea required="required" data-minlength="6" id="comment" name="comment" cols="100" rows="10"></textarea>
			<input data-id="{{$product->id}}" id="post_comment" type="submit" name"submit" class="btn" value="Comment">
		</form>
	</div>
@stop
@section('moreScripts')
{{ HTML::script('js/jquery.flexslider-min.js') }}
{{ HTML::script('js/angularScripts.js') }}
{{ HTML::script('js/spin.js') }}
<script type="text/javascript" charset="utf-8">
$(window).load(function() {
	$('.flexslider').flexslider();
		var opts = {
			lines: 7, // The number of lines to draw
			length: 25, // The length of each line
			width: 2, // The line thickness
			radius: 22, // The radius of the inner circle
			corners: 1, // Corner roundness (0..1)
			rotate: 54, // The rotation offset
			direction: 1, // 1: clockwise, -1: counterclockwise
			color: '#000', // #rgb or #rrggbb or array of colors
			speed: 2.2, // Rounds per second
			trail: 15, // Afterglow percentage
			shadow: false, // Whether to render a shadow
			hwaccel: false, // Whether to use hardware acceleration
			className: 'spinner', // The CSS class to assign to the spinner
			zIndex: 2e9, // The z-index (defaults to 2000000000)
			top: 'auto', // Top position relative to parent in px
			left: 'auto' // Left position relative to parent in px
		};
		var target = document.getElementById('spin');
		var spinner = new Spinner(opts).spin(target);
		});
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
			$('#commentArea').append(data);
		}
	});
});
//CATEGORY UPDATE
$('.categoryCheckbox').click(function(e){
	var product_id = $(this).data('productid');
	var category_id = $(this).data('categoryid');
	var checked = $(this).is(':checked') ? 1 : 0;
	var self = this
	$.ajax({
		url: "updateCategory",
		type: "POST",
		data: {
			checked: checked,
			product_id: product_id,
			category_id: category_id
		},
		success: function(data){
		}
	});
});
</script>
@stop