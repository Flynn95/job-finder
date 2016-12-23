<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * View create category page
     * @return Laravel view
     */
    public function viewManagePage()
    {
    	$categories = Category::all();
    	return view('category.create', compact('categories'));
    }

    /**
     * List all categories with posts
     * @return Laravel view
     */
    public function list()
    {
    	$categories = Category::all()->load('posts');
    	return view('category.list', compact('categories'));
    }

    /**
     * Store new category
     * @param  Request  $request 
     * @return Redirect           
     */
    public function store(Request $request) 
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $category = new Category($request->all());
        $category->save();

        return back();
    }

    public function postsListing(Category $category)
    {
        $category->load('posts')->paginate(10);
        return view('category.listPosts', compact('category'));
    }
}
