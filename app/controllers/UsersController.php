<?php

class UsersController extends BaseController {

    public function __construct()
    {

	// Enforce user authentication on specified methods
	$this->beforeFilter('csrf', ['only' => ['authenticate']]);
	 $this->beforeFilter('auth', array('except' => array('login','authenticate','getNewUser','putNewUser')));
	parent::__construct();
    }


	public function getUsers(){
		return View::make('user.users')->with('users', User::all());
	}
	public function getUser($uid)
	{
		return View::make('user.user')->with('user', User::find($uid));
	}

	public function editUser($uid)
	{
		return View::make('user.userUpdate')
			->with('user', User::find($uid));
	}

	public function postUser($uid){

		$validator = Validator::make(
        	Input::all(),
		    array(
				'username' => 'required|between:5,50|unique:users,username',
				'bio'      => 'required|between:5,500',
				'email'    => 'required|email|unique:users,email',
		    )
		);
		if ($validator->passes())
		{
			User::find($uid)->update(Input::all());
			Session::flash('status_success', 'Profile updated');
			return Redirect::back();
		} else {
			Session::flash('status_error', 'Error');
			return Redirect::back()
				->withInput(Input::all())
				->withErrors($validator->messages());
		}
	}

	public function getNewUser(){
		return View::make('auth.register');
	}

	public function putNewUser(){
			$validator = Validator::make(
		Input::all(),
		    array(
				'username'              => 'required|between:5,50|unique:users,username',
				'first_name'            => 'required|min:1',
				'last_name'             => 'required|min:1',
				'email'                 => 'required|email|unique:users,email',
				'password_confirmation' => 'required',
				'password'              => 'required|min:5|same:password_confirmation',
		    )
		);

		if($validator->passes()){
			$data = Input::all();
			$data['password'] = Hash::make($data['password']);
			$user = new User($data);
   			$user->save();
			Session::flash('status_success', 'Registerd successfuly. Please log in');
			return Redirect::intended('login');
		} else {
			Session::flash('status_error', 'Please enter valid data');	
			return Redirect::back()
				->withInput(Input::all())
				->withErrors($validator->messages());
		}
	}
}