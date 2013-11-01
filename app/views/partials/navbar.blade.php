<div class="navbar">
	<div class="navbar-inner">
		{{ HTML::route('HomePage', 'Home', array(), array('class'=>'brand')) }}
		<ul class="nav">
			<li>{{ HTML::route('AllProducts', 'Products') }}</li>
			<li>{{ HTML::route('AllUsers', 'Users') }}</li>
			<li>{{ HTML::route('newProductPage', 'New product') }}</li>
			<li><a href="#">Contact</a></li>
			<li><form action="result.php" method="post" enctype="multipart/form-data"><input name="search" type="text" class="search-query" placeholder="Search"><input type="submit" value="search" class="btn">
			</form></li>
		</ul>
	</div>
</div>