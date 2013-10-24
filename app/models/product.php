<?php

class Product extends Eloquent {
	public function color()
	{
		return $this->belongsTo('color');
	}

	public function user()
	{
		return $this->belongsTo('user');
	}

	public function images(){
		return $this->morphMany('image','entity');
	}
}