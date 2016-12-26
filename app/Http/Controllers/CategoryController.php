<?php

namespace App\Http\Controllers;

use Session;
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

    /**
     * List all posts belong to one category
     * @param  Category     $category 
     * @return Laravel view             
     */
    public function postsListing(Category $category)
    {
        $category->load('posts')->paginate(10);
        return view('category.listPosts', compact('category'));
    }

    /**
     * Delete a category and set all its posts to default category
     * @param  Category $category 
     * @return Redirect             
     */
    public function delete(Category $category)
    {
        if ($category->id == 1) {
            Session::flash('err-message', 'The default category cannot be deleted.');
            return back();
        }
        else {
            $posts = Category::find($category->id)->posts()->get();
            foreach ($posts as $post) {
                $post->category_id = 1;
                $post->update();
            }
            Category::destroy($category->id);

            Session::flash('message', 'Category deleted successfully.');
            return back();
        }
    }
}
