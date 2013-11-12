<?php

use \Utils\HashUtility;

class ProductController extends BaseController {

    public function __construct()
    {

	// Enforce user authentication on specified methods
	$this->beforeFilter('csrf', ['only' => ['authenticate']]);
	 $this->beforeFilter('auth', array('except' => array('login','authenticate','getRegister')));
	parent::__construct();
    }
/**
 * Saves the product image to database and to destination folder. Takes the id and hashes it to use as a name.
 * @param  [type] $product [description]
 * @return [type]          [description]
 */
    	private function saveProductImage($product){
		$img = new Image;
		$product->images()->save($img);
		$file            = Input::file('image');
		$extension       = Input::file('image')->getClientOriginalExtension();
		$name            = Input::file('image')->getClientOriginalName();
		$path            = HashUtility::alphaId($img->id). "." . $extension;
		$destinationPath = public_path().'/img/';
		$file->move($destinationPath, $path);
		$img->path = $path;
		$product->images()->save($img);
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
	/**
	 * Updates an existing product with new data.
	 *
	 * @param  [type] $pid -Product id, target.
	 * @return [type]      [description]
	 */
	public function postProduct($pid){

		$validator = Validator::make(
		Input::all(),
		    array(
				'name'        => 'required|between:5,50',
				'description' => 'required|between:5,500',
				'quantity'    => 'integer|required|min:1',
				'price'       => 'integer|required|min:1',
				'image'       => 'image'
		    )
		);
		if ($validator->passes())
		{
			$data = Input::all();
			$product = Product::find($pid);
			$product->update($data);
			if (Input::hasFile('image')) $this->saveProductImage($product);
			return Redirect::back()->with('message', 'Saved');
		} else {
			return Redirect::back()
				->withInput(Input::all())
				->withErrors($validator->messages());
		}
	}

	public function getNewProductPage(){
		return View::make('product.newProduct');
	}
	/**
	 * Creates the new product and adds it to the database.
	 * @return [type] [description]
	 */
	public function putProduct(){
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
	public function getProductsAdmin()
	{
		return View::make('cpanel.products')
			->with('products', Product::with('color')
			->get());
	}
}