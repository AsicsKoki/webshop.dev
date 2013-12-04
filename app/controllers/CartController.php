<?php

use \Utils\HashUtility;
use \Utils\Cart;

class CartController extends BaseController {

	public function __construct()
	{

		// Enforce user authentication on specified methods
		$this->beforeFilter('csrf', ['only' => ['authenticate']]);
		 $this->beforeFilter('auth', array('except' => array('login','authenticate','getRegister')));
		parent::__construct();
	}
	/**
	 * Generates the cart page.
	 * @return [type] [description]
	 */
	public function getCartPage(){
		if(Request::ajax()){
			return Cart::getCart();
		} else {
			return View::make('cart.cart')->with('html', Cart::getCart());
		}
	}
	/**
	 * Submits the form from the product page and adds it to the cart.
	 * @param  [type] $pid [description]
	 * @return [type]      [description]
	 */
	public function postToCart($pid){
		echo 'dsada'; exit;
		$quantity = Input::get('quantity');
		$cart = Session::get('cartData');
		$cart[$pid] = $quantity;
		Session::set('cartData', $cart);
		return Redirect::back();
	}
	public function cartDeleteEntry(){
		$pid = Input::get('pid');
		$cart = Session::get('cartData');
		unset($cart[$pid]);
		return Session::set('cartData', $cart);
	}
}