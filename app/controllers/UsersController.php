<?php

class UsersController extends BaseController {

    public function __construct()
    {

	// Enforce user authentication on specified methods
	$this->beforeFilter('csrf', ['only' => ['authenticate']]);
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
				'username'        => 'required|between:5,50',
				'bio' 			=> 'required|between:5,500',
				'email'       => 'required|min:1',
		    )
		);
		if ($validator->passes())
		{
			User::find($uid)->update(Input::all());
			return Redirect::back()->with('message', 'Saved');
		} else {
			return Redirect::back()
				->withInput(Input::all())
				->withErrors($validator->messages());
		}
	}
}