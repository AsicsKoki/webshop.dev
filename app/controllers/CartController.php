<?php

use \Utils\HashUtility;

class CartController extends BaseController {

    public function __construct()
    {

		// Enforce user authentication on specified methods
		$this->beforeFilter('csrf', ['only' => ['authenticate']]);
		 $this->beforeFilter('auth', array('except' => array('login','authenticate','getRegister')));
		parent::__construct();
    }

	public function getCart(){
		$cartItems = Session::get('cartData');
		var_dump($cartItems);
		return View::make('cart.cart', $cartItems);
	}

	public function postToCart($pid){
		if(Session::has($pid)){
			Session::forget($pid);
		}
		$quantity = Input::get('quantity');

		$cart = Session::get('cartData');
		$cart[$pid] = $quantity;
		Session::set('cartData', $cart);


		return Redirect::back();
	}
}