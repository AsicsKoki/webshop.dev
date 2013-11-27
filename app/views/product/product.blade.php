@extends('layouts/productLayout')
@section('main')
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
	</div>
@stop
@section('moreScripts')
 </script>
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
@stop