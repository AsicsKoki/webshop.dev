<?php

class UsersController extends BaseController {

	public function users(){
		return View::make('users')->with('users', User::all());
	}
}