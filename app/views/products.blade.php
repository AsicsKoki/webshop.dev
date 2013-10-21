@extends('layout')
@section('main')
	<table>
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
				<td>{{'123'}}</td>
				<td>{{$product->price}}</td>
				<td>{{'delete'}}</td>
				<td>{{$product->quantity}}</td>
			</tr>
		@endforeach
		</tbody>
	</table>
@stop