@extends('layouts/main')
@section('main')
@include('partials/categoryMenu')
	<table id="productsTable" class="table table-hover display dataTable">
		<thead>
			<th>Product name</th>
			<th>Color</th>
			<th>Price</th>
			<th>Action</th>
			<th>Quantity</th>
		</thead>
		<tbody>
		{{var_dump($result['products'])}}
		</tbody>
	</table>
@stop