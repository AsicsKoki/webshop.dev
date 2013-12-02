@extends('layouts/main')
@section('moreStyles')
@stop
@section('main')
	<table id="usersTable" class="table table-hover dataTable" class="display">
		<thead>
			<th>Username</th>
			<th>First name</th>
			<th>Last name</th>
			<th>Email</th>
			<th>Action</th>
		</thead>
		<tbody>
		@foreach($users as $user)
			<tr>
				<td>{{$user->username}}</td>
				<td>{{$user->first_name}}</td>
				<td>{{$user->last_name}}</td>
				<td>{{$user->email}}</td>
				<td>{{ HTML::route('ShowUserPage', 'Read more', array('uid'=>$user->id), array('class'=>'btn')) }}</td>
			</tr>
		@endforeach
		</tbody>
	</table>
@stop