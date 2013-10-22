<?php

class Product extends Eloquent {
	public function color()
	{
		return $this->belongsTo('color');
	}
}