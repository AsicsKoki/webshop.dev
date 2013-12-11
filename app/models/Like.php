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
}