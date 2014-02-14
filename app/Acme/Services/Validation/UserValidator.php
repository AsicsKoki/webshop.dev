<?php namespace Acme\Services\Validation;

	class UserValidator extends Validator
	{
		protected $rules = [
			'username'              => 'required|between:5,50|unique:users,username',
			'first_name'            => 'required|min:1',
			'last_name'             => 'required|min:1',
			'email'                 => 'required|email|unique:users,email',
			'password_confirmation' => 'required',
			'password'              => 'required|min:5|same:password_confirmation',

		];

		protected $updateRules = [
				'username' => 'required|between:5,50|unique:users,username',
				'bio'      => 'required|between:5,500',
				'email'    => 'required|email|unique:users,email',
		];
	}