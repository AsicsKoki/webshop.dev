<?php

class UsersController extends BaseController {

	public function getUsers(){
		return View::make('user.users')->with('users', User::all());
	}
	public function getUser($uid)
	{
		return View::make('user.user')->with('user', User::find($uid));
	}
}