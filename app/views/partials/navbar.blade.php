<div class="navbar">
	<div class="navbar-inner">
	<a href="{{ URL::route('HomePage') }}" class = "brand">Home</a></li>
		<ul class="nav">
			<li><a href="{{ URL::route('AllProducts') }}">Products</a></li>
			<li><a href="{{ URL::route('AllUsers') }}">Users</a></li>
			<li><a href="{{ URL::route('newProductPage') }}">New product</a></li>
			<li><a href="#">Contact</a></li>
			<li>
				{{ Former::open()->method('post')->action(URL::route('SearchProducts')) }}
				{{ Former::framework('Nude') }}
				{{ Former::text('search')->label(' ')->required()->placeholder('Search products') }}
				{{ Former::actions()->submit('search')->name('search')->class('pull-right') }}
				{{ Former::close() }}
			</li>
		</ul>
	</div>
</div>