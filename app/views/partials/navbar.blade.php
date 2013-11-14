<div class="navbar">
	<div class="navbar-inner">
		{{ HTML::route('HomePage', 'Home', array(), array('class'=>'brand')) }}
		<ul class="nav">
			<li>{{ HTML::route('AllProducts', 'Products') }}</li>
			<li>{{ HTML::route('AllUsers', 'Users') }}</li>
			<li>{{ HTML::route('newProductPage', 'New product') }}</li>
			<li><a href="#">Contact</a></li>
			<li>
				{{Former::open()->method('post')->action(URL::route('searchProduct'))}}
			</li>
		</ul>
	</div>
</div>