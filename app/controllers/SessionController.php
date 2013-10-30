<?php
class SessionsController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Auth/Sessions Controller
	|--------------------------------------------------------------------------
	|
	|
	*/

	public function login()
	{
		if (Auth::attempt(array('username' => $username, 'password' => Hash::make($paswword))))
		{
    	return Redirect::intended('index');
		}
	}






}