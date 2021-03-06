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

		try
		{
			return User::updateUser(Input::all());
		}

		catch(ValidationException $e)
		{
		return Redirect::back();
		Session::flash('status_error', 'Error')
			->withInput()
			->withErrors($e->getErrors());
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
		try
		{
			return User::createUser(Input::all());
		}
		catch(ValidationException $e)
		{
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
		return Review::where('id', $reviewId)->delete();
	}

	public function sendContactEmail(){
		$validator = Validator::make(
		Input::all(),
		    array(
				'msg'     => 'required|between:20,1000',
				'subject' => 'required|between:5,50',
		    )
		);

		if($validator->passes()){
			$data = Input::all();
			Mail::send('utils.emailTemplate', $data, function($message) use($data){
				$message->from( Auth::User()->email, Auth::User()->username);
				$message->to('cpt.koki@gmail.com', 'Konstantin Velickovic')->subject($data['subject']);
			});
		}
	}
}