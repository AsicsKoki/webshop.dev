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
				<td>
					{{Former::framework('Nude')}}
					{{ Former::open()->method('delete')->enctype('multipart/form-data')->action(URL::route('DeleteUser', array('uid'=>$user->id))) }}
					{{ Former::hidden('uid')->required()->value($user->id) }}
					{{ Former::hidden()->name('_token')->value(csrf_token()) }}
					{{ Former::actions()->submit('Delete') }}
					{{ Former::close() }}
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
	</div>
@stop