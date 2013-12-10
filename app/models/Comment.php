<?php
class Comment extends Eloquent {
	public function user()
	{
		return $this->belongsTo('user');
	}

	public function product()
	{
		return $this->belongsTo('product');
	}

	public function like(){
		return $this hasMany('Like');
	}

	public static function hasLikes($comment_id){

	}
}