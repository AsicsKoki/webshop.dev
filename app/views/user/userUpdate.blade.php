@extends('layouts/userLayout')
@section('main')
	<div class="span6">
		<h3>{{$user->username}}</h3>
		<div>
			{{ Former::open()->class('form-horizontal pull-left')->method('POST')->enctype('multipart/form-data')->action(URL::route('UpdateUser', array('uid'=>$user->id)))}}
			<div class='control-group'>
				{{ Former::text('username')->required()->label('username')->maxlength(12)->value($user->username) }}
			</div>
			<div class='control-group'>
				{{ Former::textarea('bio')->label('bio')->maxlength(500)->value($user->bio) }}
			</div>
			<div class='control-group'>
				{{ Former::text('email')->required()->label('Email')->value($user->email) }}
			</div>
				{{Former::hidden()->name('_token')->value(csrf_token())}}
				{{Former::actions()->submit('Submit')}}
			{{ Former::close() }}
		</div>
	</div>
@stop