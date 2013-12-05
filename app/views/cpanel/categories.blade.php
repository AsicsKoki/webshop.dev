@extends('layouts/cpanel')
@section('main')
		@include('partials.sidebar')
	<div>
		<table id="productsTable" class="table table-hover" class="display">
		<thead>
			<th>Id</th>
			<th>Category</th>
			<th>Parent id</th>
			<th>Action</th>
		</thead>
		<tbody>
		@foreach($categories as $category)
			<tr>
				<td>{{$category->id}}</td>
				<td>{{$category->name}}</td>
				<td>{{$category->parent_id}}</td>
				<td><a href=# class='deleteCategory btn btn-danger' data-cid="{{$category->id}}">Delete</a>
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
	</div>
@stop
@section('moreScripts')
<script type="text/javascript">
	$('.deleteCategory').on("click",function(e){
	e.preventDefault();
	var cid = $(this).data('cid');
	var self = this;
	$.ajax({
		url: "deleteCategory",
		type: "DELETE",
		data: {
			cid: cid
		},
		success: function(data){
			$(self).parents("tr").remove();
		}
	});
});
</script>
@stop