<?php

class ProductController extends BaseController {

	public function getProducts()
	{
		return View::make('product.products')
			->with('products', Product::with('color')
			->get());
	}

	public function getProduct($pid)
	{
		return View::make('product.product')
			->with('product', Product::with('user','images')
			->find($pid));
	}

	public function editProduct($pid)
	{
		return View::make('product.productUpdate')
			->with('product', Product::with('user','images')
			->find($pid));
	}

	public function postProduct($pid){

		$validator = Validator::make(
        	Input::get(),
		    array(
		       	'name' => 'required',
        		'description' => 'required|min:20',
        		'quantity' => 'required|min:1',
        		'price' => 'required|min:1',
		    )
		);
		if ($validator->passes())
		{
			echo "aha";
			Product::find($pid)->update(Input::get());
			return Redirect::to('products/{pid}')->with('message', 'Saved');
		}
		else{
			echo "nope";
			Redirect::back()
				->withInput(Input::get())
				->withErrors($validator);
		}
	}
}