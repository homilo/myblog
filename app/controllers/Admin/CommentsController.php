<?php

namespace Admin;

class CommentsController extends \BaseController {

	public function comments()
    {
        $comments = \Comment::all();
        return \View::make('admin.comments', compact('comments'));
    }

}