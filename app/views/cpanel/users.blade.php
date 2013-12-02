@extends('layouts/cpanel')
@section('main')
		@include('partials.sidebar')
	<div>
		<table id="usersTable" class="table table-hover display dataTable">
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
				<td>{{ HTML::route('ShowUserPage', 'Read more', array('uid'=>$user->id), array('class'=>'btn')) }}
					{{ HTML::route('ShowUserEditPage', 'Edit', array('uid'=>$user->id), array('class'=>'btn btn-warning'))}}
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