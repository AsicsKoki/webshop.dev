<?php
class Review extends Eloquent {
	protected $table = 'user_reviews';
	protected $fillable = array('user_id', 'review');

	public function user()
	{
		return $this->belongsTo('user');
	}
}