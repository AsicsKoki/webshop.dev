<?php namespace Acme\Services\Validation;
	
	class ProductValidator extends Validator
	{
		protected $rules = [
			'name'        => 'required|between:5,50',
			'description' => 'required|between:5,500',
			'quantity'    => 'integer|required|min:1',
			'price'       => 'integer|required|min:1',
			'color_id'    => 'integer|required|between:1,5',
			'image'       => 'image'

		];

		protected $updateRules = [
			'name'        => 'required|between:5,50',
			'description' => 'required|between:5,500',
			'quantity'    => 'integer|required|min:1',
			'price'       => 'integer|required|min:1',
			'image'       => 'image'
		];
	}
 