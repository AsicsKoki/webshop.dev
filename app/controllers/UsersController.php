<?php

class UsersController extends BaseController {

	public function getUsers(){
		return View::make('user.users')->with('users', User::all());
	}
	public function getUser($uid)
	{
		return View::make('user.user')->with('user', User::find($uid));
	}

	public function editUser($uid)
	{
		return View::make('User.UserUpdate')
			->with('User', User::find($uid));
	}

	public function postUser($uid){

		$validator = Validator::make(
        	Input::all(),
		    array(
				'name'        => 'required|between:5,50',
				'description' => 'required|between:5,500',
				'quantity'    => 'integer|required|min:1',
				'price'       => 'integer|required|min:1',
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
}