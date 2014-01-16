@extends('layouts/cpanel')
@section('main')
	<div>
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
					<td>
						<a href="{{ URL::route('ShowProductPage', $product->id) }} " class='btn'>Read more</a>
						<a href="{{ URL::route('ShowProductEditPage', $product->id) }} " class='btn btn-danger'>Edit</a>
						{{Former::framework('Nude')}}
						{{ Former::open()->method('delete')->enctype('multipart/form-data')->action(URL::route('DeleteProduct', array('pid'=>$product->id))) }}
						{{ Former::hidden('pid')->required()->value($product->id) }}
						{{ Former::hidden()->name('_token')->value(csrf_token()) }}
						{{ Former::actions()->submit('Delete') }}
						{{ Former::close() }}
					</td>
					<td>{{$product->quantity}}</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
@stop