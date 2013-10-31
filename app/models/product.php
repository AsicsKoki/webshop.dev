<?php

class Product extends Eloquent {

	/**
   * Define which attributes can be filled
   * via MassAssignment
   */
	protected $fillable = array('quantity', 'price', 'description', 'name');
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