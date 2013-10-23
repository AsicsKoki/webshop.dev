@extends('layouts/main')
@section('main')
	<table id="productsTable" class="table table-hover" class="display">
		<thead>
			<th>Product name</th>
			<th>Color</th>
			<th>Price</th>
			<th>Action</th>
			<th>Quantity</th>
		</thead>
		<tbody>
		@foreach($products as $product)
			<tr>
				<td>{{$product->name}}</td>
				<td>{{$product->color->color_name}}</td>
			</tr>
		@endforeach
		</tbody>
	</table>
@stop