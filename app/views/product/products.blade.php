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
		@foreach($products as $product)
			<tr>
				<td>{{$product->name}}</td>
				<td>{{$product->color->color_name}}</td>
				<td>{{$product->price}}</td>
				<td><a href="{{ URL::route('ShowProductPage', $product->id) }} " class='btn'>Read more</a></td>
				<td>{{$product->quantity}}</td>
			</tr>
		@endforeach
		</tbody>
	</table>
@stop