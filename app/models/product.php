<?php

class Product extends Eloquent {

	/**
   * Define which attributes can be filled
   * via MassAssignment
   */
	protected $fillable = array('quantity', 'price', 'description', 'name', 'user_id', 'color_id');
	public function color()
	{
		return $this->belongsTo('color');
	}

	public function user()
	{
		return $this->belongsTo('user');
	}

	public function images(){
		return $this->morphMany('image','imageable');
	}

	public static function search($keyword){
		return static::where('name', 'LIKE', '%'.$keyword.'%')->orWhere('description', 'LIKE', '%'.$keyword.'%');
	}
}