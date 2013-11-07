<?php

use \Utils\HashUtility;

class RegisterController extends BaseController {


public function putNewUser(){
			$validator = Validator::make(
		Input::all(),
		    array(
				'name'        => 'required|between:5,50',
				'description' => 'required|between:5,500',
				'quantity'    => 'integer|required|min:1',
				'price'       => 'integer|required|min:1',
				'color_id'    => 'integer|required|between:1,5',
				'image'       => 'image'
		    )
		);
		if($validator->passes()){
			$data = Input::all();
			$data['user_id']= Auth::User()->id;
			$product = Product::create($data);
			if (Input::hasFile('image')) $this->saveProductImage($product);
			return Redirect::intended('products');
		} else {
			return Redirect::back()
				->withInput(Input::all())
				->withErrors($validator->messages());
		}
	}
}