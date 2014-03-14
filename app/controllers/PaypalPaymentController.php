<?php

class PaypalPaymentController extends BaseController {

	/**
	* object to authenticate the call.
	* @param object $_apiContext
	*/
	private $_apiContext;

	/**
	* Set the ClientId and the ClientSecret.
	* @param
	*string $_ClientId
	*string $_ClientSecret
	*/
	private $_ClientId='AbAl5hD4c2zyurExqyCDLnDpk5snS-qd7q7Y3RwqwB9r4uL_TskIHdg_VGTc';
	private $_ClientSecret='EFQgdxAiBDDwkg_J83KxGEhC1_q7Ri6N9W4PoXlXHKtRhECCPElPxCZp4VJ-';

	/*
	*   These construct set the SDK configuration dynamiclly,
	*   If you want to pick your configuration from the sdk_config.ini file
	*   make sure to update you configuration there then grape the credentials using this code :
	*   $this->_cred= Paypalpayment::OAuthTokenCredential();
	*/
    public function __construct()
    {
	   // ### Api Context
	   // Pass in a `ApiContext` object to authenticate
	   // the call. You can also send a unique request id
	   // (that ensures idempotency). The SDK generates
	   // a request id if you do not pass one explicitly.

	   $this->_apiContext = Paypalpayment:: ApiContext(
		  Paypalpayment::OAuthTokenCredential(
			 $this->_ClientId,
			 $this->_ClientSecret
		  )
	   );
    }
    	public function create(){

		$data = Session::get('cartData');
		$total = 0;
		foreach ($data as $id => $quantity) {
			$price = Product::find($id)->price;
			$total += $price*(int)$quantity;
		}

		$data = [
			'type'             => Input::get('creditCardType'),
			'creditCardNumber' => Input::get('creditCardNumber'),
			'cvv2'             => Input::get('creditCardSecurityNumber'),
			'expireMonth'      => Input::get('creditCardExpiryMonth'),
			'expireYear'       => Input::get('creditCardExpiryYear'),
			'firstName'        => Input::get('firstName'),
			'lastName'         => Input::get('lastName'),
			'total'            => $total
			];
		Queue::push('PaymentQueue', $data);
	}
	/*
	Use this call to get a list of payments.
	url:payment/
	*/
	public function index(){
		echo "<pre>";
		$payments = Paypalpayment::all(array('count' => 1, 'start_index' => 0),$this->_apiContext);
		print_r($payments);
	}

	/*
	Use this call to get details about payments that have not completed, 
	such as payments that are created and approved, or if a payment has failed.
	url:payment/PAY-3B7201824D767003LKHZSVOA
	*/

	public function show($payment_id){
		$payment = Paypalpayment::get($payment_id,$this->_apiContext);
		echo "<pre>";
		print_r($payment);
	}
}