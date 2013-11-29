@extends('layouts/cpanel')
@section('main')
		@include('partials.sidebar')
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
						{{ HTML::route('ShowProductEditPage', 'Edit', array('pid'=>$product->id), array('class'=>'btn btn-warning'))}}
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
@section('moreScrypts')
	<script type="text/javascript">
		$('#productsTable').dataTable();
	</script>
@stop