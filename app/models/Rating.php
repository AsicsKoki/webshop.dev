<?php
class Rating extends Eloquent {
	protected $table = 'product_ratings';
	protected $fillable = array('product_id', 'user_id', 'rating');

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function product()
	{
		return $this->belongsTo('Product');
	}
}