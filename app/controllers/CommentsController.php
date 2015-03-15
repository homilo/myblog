<?php

class CommentsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /comments
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /comments/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /comments
	 *
	 * @return Response
	 */
	public function store()
	{
		$id = 0;

		if ( Auth::check() ) 
		{
			// Validator for User comment
			$validator_ucomment = Comment::validate($data_ucomment = Input::all());

			if ($validator_ucomment->fails())
	        {
	            return Redirect::back()->withErrors($validator_ucomment)->withInput();
	        }

	        // print_r($data_ucomment); exit();

	        Comment::create([
	        	'post_id' 	=> $data_ucomment['post_id'],
	        	'reply_id' 	=> $data_ucomment['reply_id'],
	        	'content' 	=> $data_ucomment['content'],
	        	'user_id' 	=> $data_ucomment['user_id']
	        ]);

	        $id = $data_ucomment['post_id'];
		} 
		else 
		{
			// Validator for Guest comment
			$validator_gcomment = Guestcomment::validate($data_gcomment = Input::all());

			if ( $validator_gcomment->fails() )
	        {
	            return Redirect::back()->withErrors($validator_gcomment)->withInput();
	        }

	        print_r($data_gcomment['email']); exit();
	        $comment = Comment::create([
	        	'post_id' 	=> $data_gcomment['post_id'], 
	        	'content' 	=> $data_gcomment['content']
	        ]);

	        Guestcomment::create([
	        	'comment_id'	=> $comment->id,
	        	'name'			=> $data_gcomment['name'],
	        	// 'website' 		=> $data_gcomment['website'],
	        	'email' 		=> $data_gcomment['email']
	        ]);

	        $id = $data_gcomment['post_id'];
		}
        
        return Redirect::route("posts.show", $id)->withSuccess(Lang::get('larabase.comment_created'));
	}

	/**
	 * Display the specified resource.
	 * GET /comments/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /comments/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /comments/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /comments/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}