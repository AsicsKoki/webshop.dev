<?php

class Product extends BaseModel {

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
        return round($this->ratings()->avg('rating'));
	}

	public function comments()
	{
		return $this->hasMany('Comment');
	}

	public static function createProduct($data){
		$data['user_id']= Auth::User()->id;
		$product = Product::create($data);
		if (Input::hasFile('image')) $this->saveProductImage($product);
		Session::flash('status_success', 'Product created');
		return Redirect::intended('products');
	}

	public static function updateProduct($data){
		$product = Product::find($pid);
		$product->update($data);
		if (Input::hasFile('image')) $this->saveProductImage($product);
		return Redirect::back()->with('message', 'Saved');
	}
}