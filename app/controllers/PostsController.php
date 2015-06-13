<?php

class PostsController extends \BaseController {

    /**
     * This Constructor is called after the creation of a new PostsController object
     *
     */
    public function __construct()
    {
        // Check Auth trước khi thực thi các hàm phía dưới, except là ngoại trừ 
        $this->beforeFilter('auth', ['except' => ['index', 'show', 'postsForTag', 'postsForCategory', 'postsForSearch', 'postsForUser']]);

        $this->beforeFilter('resource_owner', ['only' => ['edit', 'update', 'destroy']]);
    }

    /**
     * Display a listing of posts
     *
     */
    public function index()
    {
        $posts = Post::orderBy('updated_at', 'desc')->paginate(5);
        return View::make('posts.index', compact('posts'));
    }

    /**
     * Display a list of posts for a User
     *
     */
    public function postsForUser($username)
    {
        $user = User::whereUsername($username)->first();
        $posts = $user->posts()->orderBy('updated_at', 'desc')->paginate(5);
        return View::make('posts.post_user', compact('posts','username'));
    }

    /**
     * Display a list of posts for a Category
     *
     */
    public function postsForCategory($category_name)
    {
        $category = Category::where('name', $category_name)->firstOrFail();
        $posts = $category->posts()->orderBy('updated_at', 'desc')->paginate(5);
        return View::make('posts.post_category', compact('posts', 'category_name'));
    }

    /**
     * Display a list of posts for a Tag
     *
     */
    public function postsForTag($tag_name)
    {
        $tag = Tag::where('name', $tag_name)->firstOrFail();
        $posts = $tag->posts()->orderBy('updated_at', 'desc')->paginate(5);
        return View::make('posts.post_tag', compact('posts', 'tag_name'));
    }

    /**
     * Display a list of posts for a Search
     * Update 02/05/2015 Loi
     */
    public function postsForSearch()
    {
        $key_search = Input::get('key_search');
        $posts = Post::whereRaw("MATCH(title,content) AGAINST(? IN BOOLEAN MODE)", [$key_search] )->paginate(5);
        
        // foreach ($posts as $post) {
        //     $title = $post->title;
        //     $post->title = str_replace($key_search, '<b>'. $key_search .'</b>', $title);
        // }

        return View::make('posts.post_search', compact('posts', 'key_search'));
    }

    /**
     * Show the form for creating a new post
     *
     */
    public function create()
    {
        $user_id = Auth::user()->id;
        $categories = DB::table('categories')->lists('name','id');
        $default_category_id = Category::first()->id;
        $tags = DB::table('tags')->get(['id', 'name']);
        $default_tag_id = [Tag::first()->id];
        return View::make('posts.create', compact('user_id', 'categories', 'default_category_id', 'default_tag_id', 'tags'));
    }

    /**
     * Store a newly created post in DB.
     *
     */
    public function store()
    {
        $validator = Post::validate($data = Input::all());
        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        // We remove quotes from tag_ids with array_map intval
        $tag_ids = array_map('intval', $data['tags']);
        $post = Post::create(['user_id'=>$data['user_id'], 'title'=>$data['title'], 'content'=>$data['content'], 'status'=>$data['status']]);
        $post->tags()->sync($tag_ids);
        $post->categories()->attach($data['category']);
        Event::fire('post.created', array($data));
        return Redirect::route('posts.index')->withSuccess(Lang::get('larabase.post_created'));
    }

    /**
     * Display the specified post
     *
     */
    public function show($id)
    {   
        $user_id = false;
        if(Auth::check()){
            $user_id = Auth::user()->id;
        }
        
        $post = Post::with('user')->find($id);
        // $comments = Comment::with('user.profile')->where('post_id', '=', $id)->get();
        // $comments = Comment::with('children')->where('post_id', '=', $id)->get();
        $comments = Comment::with('children')->whereRaw('post_id = ? and status = 1', array($id))->get();

        return View::make('posts.show', compact('user_id', 'post', 'comments'));
    }

    /**
     * Show the form for editing the specified post
     *
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $tags = Tag::all();
        $categories = DB::table('categories')->lists('name','id');
        $selected_category = $post->categories->lists('id');
        $selected_tags = $post->tags->lists('id');
        return View::make('posts.edit', compact('post', 'categories', 'selected_category', 'tags', 'selected_tags'));
    }

    /*
     * Update the specified resource in storage
     *
     */
    public function update($id)
    {
        $post = Post::findOrFail($id);
        $validator = Validator::make($data = Input::all(), Post::$rules);
        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        // We remove quotes from tag_ids with array_map intval
        $tag_ids = array_map('intval', $data['tags']);
        $post->update(['title'=>$data['title'], 'content'=>$data['content'], 'status'=>$data['status']]);
        $post->categories()->sync([$data['category']]);
        $post->tags()->sync($tag_ids);
        return Redirect::route('posts.show', $id)->withInfo(Lang::get('larabase.post_updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy($id)
    {
        // Delete all records on the Post-Tag and Post-Category pivot table
        Post::find($id)->tags()->detach();
        Post::find($id)->categories()->detach();
        Post::destroy($id);
        return Redirect::route('posts.index')->withInfo(Lang::get('larabase.post_deleted'));
    }

    // Upload new Category Image
    /*
     * Update 02/05/2015 Loi
     */
    public function uploadPostImage($id)
    {
        if (Input::hasFile('image'))
        {
            $validator = Validator::make(['image' => $image = Input::file('image')],['image' => 'image|mimes:jpeg,bmp,png|max:2048']);
            if ($validator->fails())
            {
                return Redirect::back()->withInput()->withErrors($validator);
            }

            $post = Post::find($id);

            if($post->image) {
                $oldFile = public_path('uploads/posts_img/').$post->image;
                File::delete($oldFile);
            }

            // $filename = time() .'-'. $image->getClientOriginalName();

            $filename = $image->getClientOriginalName();
            $extension = File::extension($filename);

            $filename = str_replace(' ', '_', $post->title);
            $filename = preg_replace( '([^a-zA-Z0-9_])', '', $filename );
            $filename = $filename . '_' . time() . '.' . $extension; 

            $image->move('uploads/posts_img', $filename);

            $post->image = $filename;
            $post->save();
            return Redirect::back()->withSuccess(Lang::get('larabase.post_updated'));
        }
        return Redirect::back();
    }

    // Upload Content Image of Post
    /*
     * Hình ảnh trong nội dung của bài viết
     * Update 17/05/2015 Loi
     */
    // public function uploadContentImage() {

        // $validator = Validator::make(['image' => $image = Input::file('file')],['image' => 'image|mimes:jpeg,bmp,png|max:2048']);
        // if ($validator->fails())
        // {
        //     return;
        // }

        // $post = Post::find($id);

        // $filename = $image->getClientOriginalName();
        // $extension = File::extension($filename);

        // $filename = str_replace(' ', '_', $post->title);
        // $filename = preg_replace( '([^a-zA-Z0-9_])', '', $filename );
        // $filename = $filename . '_' . time() . '.' . $extension; 

        // $image->move('uploads/posts_img', $filename);

        // // print_r(public_path("uploads/posts_img") . $filename);
        // // exit();

        // // Generate response.
        // $response = new StdClass;
        // $response->link = public_path("uploads/posts_img") . $filename;
        // echo stripslashes(json_encode($response));

    // }
}