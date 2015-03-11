<?php

class Comment extends \Eloquent {

	protected $table = 'comments';

	protected $fillable = ['content'];

	public static $rules = [
		'content' => 'required|min:10',
		'user_id' => 'required',
		'post_id' => 'required'
	];

	public static function validate($data){
		return Validator::make($data, static::$rules);
	}

	public function post()
	{
		return $this->belongsTo('Post');
	}

	public function user() 
	{
		return $this->belongsTo('User');
	}

	public function parent()
    {
        return $this->belongsTo('Comment', 'reply_id');
    }

    public function children()
    {
        return $this->hasMany('Comment', 'reply_id');
    }
}