<?php

class ProductController extends BaseController {

	public function getProducts()
	{
		return View::make('product.products')->with('products', Product::with('color')->get());
	}

	public function getProduct($pid)
	{
		return View::make('product.product')->with('product', Product::with('user','images')->find($pid));
	}
	public function postProduct(){
	}
}