<?php

class UsersController extends BaseController {

	public function users(){
		return View::make('user.users')->with('users', User::all());
	}
}