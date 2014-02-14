<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends BaseModel implements UserInterface, RemindableInterface {

	protected $fillable = array('username', 'first_name', 'last_name', 'bio', 'email', 'password');
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	public function images(){
		return $this->morphMany('image','imageable');
	}

	public function isAdmin()
	{
		return $this->role->role == 'admin';
	}

	public function role()
	{
		return $this->belongsTo('Role');
	}

	public function ratings()
	{
		return $this->hasMany('Rating');
	}

	public function comments()
	{
		return $this->hasMany('Comment');
	}

	public function likes()
	{
		return $this->hasMany('Like');
	}

	public function products()
	{
		return $this->hasMany('Product');
	}

	public function reviews()
	{
		return $this->hasMany('Review');
	}

	public static function createUser($data){
		$data['password'] = Hash::make($data['password']);
		$user = new User($data);
   		$user->save();
		Session::flash('status_success', 'Registerd successfuly. Please log in');
		return Redirect::intended('login');
	}

	public static function updateUser($data){
		User::find($uid)->update(Input::all());
		Session::flash('status_success', 'Profile updated');
		return Redirect::back();
	}

}