<div style="float: right;">
	<a href="{{ URL::route('showCart') }} " class='btn'>Show cart</a>
	<a href="{{ URL::route('showProfilePage', Auth::user()->id) }}"><button class="btn btn-info">Profile</button></a>
	<a href="{{ URL::route('logout') }} " class='btn btn-danger'>Log out</a>
</div>