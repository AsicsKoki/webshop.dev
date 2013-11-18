@extends('layouts/main')
@section('main')
	<div id="result">
		<table id="productsTable" class="table table-hover" class="display">
			<thead>
				<th>Name</th>
				<th>Quantity</th>
				<th>Price per item</th>
				<th>Action</th>
				<th>Total price</th>
			</thead>
			<tbody>
				
			</tbody>
		</table>
		<a class="btn" href="order.php">Checkout</a>
	</div>
@stop