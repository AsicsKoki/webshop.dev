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

	public function ratings()
	{
		return $this->hasMany('Rating');
	}

	public function images(){
		return $this->morphMany('image','imageable');
	}

	public static function search($keyword){
		return static::where('name', 'LIKE', '%'.$keyword.'%')->orWhere('description', 'LIKE', '%'.$keyword.'%');
	}

	public function category(){
		return $this->belongsToMany('category', 'categorized_products');
	}
	/**
	 * Calculates the rating of the product
	 * @param  [type] $productId [description]
	 * @return [type]            [description]
	 */
	public function calculateRating(){
        return $this->ratings()->avg('rating');
	}
}