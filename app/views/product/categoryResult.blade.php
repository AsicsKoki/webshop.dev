@extends('layouts/main')
@section('main')
@include('partials/categoryMenu')
	<div>Showing results for the <h5>{{$result['name']}}</h5> category </div>
	<table id="productsTable" class="table table-hover display dataTable">
		<thead>
			<th>Product name</th>
			<th>Price</th>
			<th>Action</th>
			<th>Quantity</th>
		</thead>
		<tbody>
			@foreach ($result['products'] as $data)
				<tr>
					<td>{{$data['name']}}</td>
					<td>{{$data['price']}}</td>
					<td><a href="{{ URL::route('ShowProductPage', $data['id']) }} " class='btn'>Read more</a></td>
					<td>{{$data['quantity']}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@stop