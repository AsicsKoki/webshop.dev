<?php

class ProductController extends BaseController {

	public function products(){
		return View::make('product.products')->with('products', Product::with('color')->get());
	}

	public function product($pid){
		return View::make('product.product')->with('products', Product::find($pid));
	}
}