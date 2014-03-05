<?php
class Sale extends Eloquent {
	protected $table = 'sales';
	protected $fillable = array('user_id', 'state', 'total', 'paypal_id');

	public function user()
	{
		return $this->belongsTo('user');
	}

	public static function createSaleRecord($saleData){
		$sale = new Sale($saleData);
   		$sale->save();
   		Session::forget('cartData');
	}
}