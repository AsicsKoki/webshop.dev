<?php

class UsersController extends BaseController {

	protected $fillable = array('username', 'first_name', 'last_name', 'bio', 'email');
	public function getUsers(){
		return View::make('user.users')->with('users', User::all());
	}
	public function getUser($uid)
	{
		return View::make('user.user')
			->find($pid));
	}
}