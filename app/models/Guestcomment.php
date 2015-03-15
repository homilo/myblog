<?php

class Guestcomment extends \Eloquent {
	protected $table = 'guestcomments';

	protected $fillable = ['comment_id'];

	public static $rules = [
		'name' => 'required',
		'email' => 'required|email'
	];

	public static function validate($data){
		return Validator::make($data, static::$rules);
	}

	public function comment()
	{
		return $this->belongsTo('Comment');
	}
}