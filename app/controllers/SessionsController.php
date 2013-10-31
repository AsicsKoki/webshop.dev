<?php
class SessionsController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Auth/Sessions Controller
	|--------------------------------------------------------------------------
	|
	|
	*/
    public function __construct()
    {

	// Enforce user authentication on specified methods
	$this->beforeFilter('csrf', ['only' => ['authenticate']]);
	parent::__construct();
    }


	public function login(){
		return View::make('auth.login');
	}

	public function authenticate(){
		 $credentials = array(
			'username' => Input::get('username'),
			'password' => Input::get('password')
		  );

		if(Auth::attempt($credentials)){
			return Redirect::intended('/');
		} else {
			return Redirect::to('/login');
		}
	}
	public function logout(){
		Auth::logout();
		return Redirect::to('/login');
	}
}