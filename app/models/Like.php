<?php
class Like extends Eloquent {
	protected $table = 'comment_likes';
	public function user()
	{
		return $this->belongsTo('User');
	}

	public function comment()
	{
		return $this->belongsTo('Comment');
	}
}