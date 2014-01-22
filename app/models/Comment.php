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

	public function likes(){
		return $this->hasMany('Like');
	}

	public static function isLiked($comment_id, $user_id){
		return Like::where('comment_id', '=', $comment_id)->where('user_id', '=', $user_id)->count();
	}
}