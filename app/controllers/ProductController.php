<?php

class ProductController extends BaseController {

    public function __construct()
    {

	// Enforce user authentication on specified methods
	$this->beforeFilter('csrf', ['only' => ['authenticate']]);
	parent::__construct();
    }


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
			Product::find($pid)->update(Input::all());
			return Redirect::back()->with('message', 'Saved');
		} else {
			return Redirect::back()
				->withInput(Input::all())
				->withErrors($validator->messages());
		}
		if (Input::hasFile('image')) {
	        $file            = Input::file('image');
	        $destinationPath = public_path().'/img/';
	        $filename        = str_random(6) . '_' . $file->getClientOriginalName();
	        $uploadSuccess   = $file->move($destinationPath, $filename);
   		}
	}

	public function getNewProductPage(){
		return View::make('product.newProduct');
	}

	public function putProduct(){
			$validator = Validator::make(
        	Input::all(),
		    array(
				'name'        => 'required|between:5,50',
				'description' => 'required|between:5,500',
				'quantity'    => 'integer|required|min:1',
				'price'       => 'integer|required|min:1',
		    )
		);
		if($validator->passes()){
			$data = Input::all();
			$data['user_id']= Auth::User()->id;
			Product::create($data);
			return Redirect::intended('products');
		}
	}
}