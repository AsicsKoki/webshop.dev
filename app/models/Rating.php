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

	public function saveRating($rating, $pid, $uid) {
		$product = Product::find($pid);
		$this->user_id = $uid;
		$this->rating = $rating;
	  	$product->rating()->attach($this);
	}
}