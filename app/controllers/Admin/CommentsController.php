<?php

namespace Admin;

class CommentsController extends \BaseController {

	public function comments()
    {
        $comments = \Comment::all();
        $pedding_comments = \Comment::where('status', '0');
        return \View::make('admin.comments', compact('comments', 'pedding_comments'));
    }

}