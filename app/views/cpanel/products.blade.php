@extends('layouts/cpanel')
@section('main')
	<div>
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
					<td>{{$product->price}}</td>
					<td>
						{{ HTML::route('ShowProductPage', 'Read more', array('pid'=>$product->id), array('class'=>'btn')) }}
						{{HTML::route('ShowProductEditPage', 'Edit', array('pid'=>$product->id), array('class'=>'btn btn-warning'))}}
						<a class="btn btn-danger" href="#">Delete</a>
					</td>
					<td>{{$product->quantity}}</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
@stop