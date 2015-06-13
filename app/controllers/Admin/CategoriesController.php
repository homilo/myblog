<?php

class CategoriesController extends \BaseController {

	/**
	 * Display a listing of categories
	 *
	 * @return Response
	 */
	public function index()
	{
		$categories = Category::all();
		return View::make('categories.index', compact('categories'));
	}

	/**
	 * Store a newly created category in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Category::validate($data = Input::all());
		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
		Category::create($data);
		return Redirect::route('admin.categories.index');
	}

	/**
	 * Show the form for editing the specified category.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$category = Category::find($id);
		return View::make('categories.edit', compact('category'));
	}

	/**
	 * Update the specified category in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$category = Category::findOrFail($id);
		$validator = Category::validate($data = Input::all());
		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
		$category->update($data);
		return Redirect::route('admin.categories.index');
	}

	/**
	 * Remove the specified category from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Category::destroy($id);
		return Redirect::route('admin.categories.index');
	}


	// Upload new Category Image
	/*
	 * Update 30/04/2015 Loi
	 */
	public function uploadCategoryImage($id)
	{
		if (Input::hasFile('image'))
		{
			$validator = Validator::make(['image' => $image = Input::file('image')],['image' => 'image|mimes:jpeg,bmp,png|max:2048']);
			if ($validator->fails())
			{
				return Redirect::back()->withInput()->withErrors($validator);
			}

			$category = Category::find($id);

			if($category->image) {
				$oldFile = public_path('uploads/categories_img/').$category->image;
				File::delete($oldFile);
			}

			$filename = $image->getClientOriginalName();
            $extension = File::extension($filename);

            $filename = str_replace(' ', '_', $category->name);
            $filename = preg_replace( '([^a-zA-Z0-9_])', '', $filename );
            $filename = $filename . '_' . time() . '.' .$extension; 

			$image->move('uploads/categories_img', $filename);

			$category->image = $filename;
			$category->save();
			return Redirect::back()->withSuccess(Lang::get('larabase.category_updated'));
		}
		return Redirect::back();
	}

}