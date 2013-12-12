<?php
class Like extends Eloquent {
	protected $table = 'comment_likes';
	protected $fillable = array('comment_id', 'user_id');
	public function user()
	{
		return $this->belongsTo('User');
	}

	public function comment()
	{
		return $this->belongsTo('Comment');
	}

	public static function countLikes($comment_id){
		return Like::where('comment_id', '=', $comment_id)->count();
	}

	public static function likedBy($comment_id){
		return Like::where('comment_id', '=', $comment_id)->with('user')->get();
	}
}