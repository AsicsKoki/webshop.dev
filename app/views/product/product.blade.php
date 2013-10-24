@extends('layouts/main')
@section('main')
	<div class="user-box pull-right">
		<header>Posted by :</header>
		<!-- <img src="files/<?php echo $poster['image_name'] ?>" alt=""> -->
		<!-- <h5><a href="user.php?id=<?php echo $user_id ?>"><?php echo $poster['username'] ?></a></h5> -->
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
		</div>
	</div>
@stop