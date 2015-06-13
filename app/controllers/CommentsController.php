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
		// commenter is user
		if ( Auth::check() ) 
		{
			// Validator for User comment
			$validator_ucomment = Comment::validate($data_ucomment = Input::all());

			if ($validator_ucomment->fails())
	        {
	            return Redirect::back()->withErrors($validator_ucomment)->withInput();
	        }

	        $comment = new Comment;
	        $comment->post_id = $data_ucomment['post_id'];
	        $comment->reply_id = $data_ucomment['reply_id'];
	        $comment->content = $data_ucomment['content'];
	        $comment->user_id = $data_ucomment['user_id'];
	        $comment->save();

	        $id = $data_ucomment['post_id'];
		} 
		// Commenter is guest
		else 
		{
			// 1. Validator for Guest comment
			$validator_gcomment = Guestcomment::validate($data_gcomment = Input::all());

			if ( $validator_gcomment->fails() )
	        {
	            return Redirect::back()->withErrors($validator_gcomment)->withInput();
	        }

	        // 2. Check guest email has exist?
	        $checkEmail = User::where('email', '=', $data_gcomment['email'])->get()->toArray();

	        $isEmailExist = count($checkEmail) == 0 ? false : true;

	        // print_r($checkEmail); exit();

	        if( $isEmailExist == false ) {
	        	// 2.1. Create new user + profile
	        	$user = new User;
	        	$user->username = str_replace("@", "_", $data_gcomment['email']);
	        	$user->email = $data_gcomment['email'];
	        	$user->type = 0; // type is guest
	        	$user->save();

	        	$user_id = $user->id;

	        	$profile = new Profile;
	        	$profile->first_name = $data_gcomment['name'];
	        	$profile->last_name = "[guest]";
	        	$profile->user_id = $user_id;
	        	$profile->save();

	        } else {
	        	$user_id = $checkEmail[0]["id"];
	        }

	        // 3. Update first name IF field NAME different empty + usertype is GUEST



	        // 4. Create new comment
	        $comment = new Comment;
	        $comment->post_id = $data_gcomment['post_id'];
	        $comment->content = $data_gcomment['content'];
	        $comment->user_id = $user_id;
	        $comment->save();

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