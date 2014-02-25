@extends('layouts/main')
@section('main')
	<div id="result">
		<table id="productsTable" class="table table-hover display">
			<thead>
				<th>Name</th>
				<th>Quantity</th>
				<th>Price per item</th>
				<th>Action</th>
				<th>Total price</th>
			</thead>
			<tbody>
			{{$html}}
			</tbody>
		</table>
		@include('partials.creditCardForm')
	</div>
@stop