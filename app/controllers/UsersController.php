<?php

class UsersController extends BaseController {

    public function __construct()
    {
		// Enforce user authentication on specified methods
		$this->beforeFilter('csrf', ['only' => ['authenticate']]);
		$this->beforeFilter('admin', ['only' => ['getUsersBackend', 'deleteUser', 'postUser']]);
		$this->beforeFilter('auth', array('except' => array('login','authenticate','getNewUser','putNewUser')));
		parent::__construct();
    }

    /**
     * Cretas the users view and table.
     * @return [type] [description]
     */
	public function getUsers(){
		return View::make('user.users')->with('users', User::all());
	}

	/**
	 * Creates the user profile page.
	 * @param  [type] $uid [description]
	 * @return [type]      [description]
	 */
	public function getUser($uid)
	{
		return View::make('user.user')
			->with('user', User::with('products','ratings','likes', 'comments')
			->find($uid));
	}
	public function getProfile($uid)
	{
		return View::make('user.profile')
			->with('user', User::with('products','ratings','likes', 'comments')
			->find($uid));
	}

	/**
	 * Creates the user edit page.
	 * @param  [type] $uid [description]
	 * @return [type]      [description]
	 */
	public function editUser($uid)
	{
		return View::make('user.userUpdate')
			->with('user', User::find($uid));
	}

	/**
	 * Updates user info.
	 * @param  [type] $uid [description]
	 * @return [type]      [description]
	 */
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

	/**
	 * Create user registration page and save a new user.
	 * @return [type] [description]
	 */
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

	/**
	 * Generates the backend users list
	 * @return [type] [description]
	 */
	public function getUsersBackend(){
		return View::make('cpanel.users')->with('users', User::all());
	}

	/**
	 * Deletes the user from the database.
	 * @param  [type] $uid User id.
	 * @return [type]      [description]
	 */
	public function deleteUser($uid){
		User::find($uid)->delete();
		Session::flash('status_success', 'User removed');
		return Redirect::intended('admin/users');
	}

	public function getComments($uid){
		return View::make('user.comments')->with('comments', User::find($uid)->comments->toArray());
	}

	public function getCommentsRaw($uid){
		return User::find($uid)->comments;
	}

	public function getProfileJson($uid){
		return User::with('products','ratings','likes', 'comments', 'reviews.user')
			->find($uid);
	}

	public function postReview(){
		$validator = Validator::make(
		Input::all(),
		    array(
				'review' => 'required|between:5,50',
		    )
		);
		if($validator->passes()){
			return Review::create(Input::all());
		}
	}

	public function deleteReview($reviewId){
		return Review::where('id', '=', $reviewId)->delete();
	}
}