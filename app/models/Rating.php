<?php
class Rating extends Eloquent {
	protected $fillable = array('product_id', 'user_id', 'rating');
	protected $table = 'product_ratings';
}