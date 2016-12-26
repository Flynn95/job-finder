<?php

namespace App\Http\Controllers;

use Session;
use App\Post;
use App\Category;
use App\Http\Requests;
use Illuminate\Http\Request;

class PostController extends Controller
{
	/**
	 * List all post from database
	 * @return Laravel view
	 */
    public function list()
    {
    	$posts = Post::all();
    	return view('post.index', compact('posts'));
    }

    /**
     * Show a single post
     * @param  Post   $post Post id request
     * @return Laravel view
     */
    public function show(Post $post)
    {
    	$post->load('user', 'comments.user');
    	return view('post.show', compact('post'));
    }

    /**
     * Send Categories list to view
     * @return Laravel view 
     */
    public function viewCreatePage()
    {
    	$categories = Category::all();
    	return view('post.create', compact('categories'));
    }

    /**
     * Store post onto database
     * @param  Request $request 
     * @return Redirect           Redirect with session message
     */
    public function store(Request $request)
    {
    	$this->validate($request, [
    		'title' => 'required|min:10',
    		'content' => 'required|min:30'
    	]);

    	$post = new Post($request->all());
    	$post->user_id = 1;
    	$post->save();

    	Session::flash('message', 'Your post has published successfully.');
    	return back();
    }

    /**
     * Send a view for editing post
     * @param  Post   $post 
     * @return Laravel view
     */
    public function edit(Post $post)
    {
    	$categories = Category::all();
    	return view('post.edit', compact('post', 'categories'));
    }

    /**
     * Update post
     * @param  Request $request
     * @param  Post    $post    
     * @return Redirect
     */
    public function update(Request $request, Post $post)
    {
    	$post->update($request->all());

    	Session::flash('message', 'Your post has been updated successfully.');
    	return back();
    }

    /**
     * Delete post
     * @param  Post     $post 
     * @return Redirect       
     */
    public function delete(Post $post)
    {
    	Post::destroy($post->id);
        Session::flash('message', 'Post deleted successfully.');
    	return redirect('/posts');
    }
    public function deleteFromManage(Post $post)
    {
        Post::destroy($post->id);
        Session::flash('message', 'Post deleted successfully.');
        return back();
    }

    /**
     * Show posts manage page
     * @return Laravel view 
     */
    public function viewManagePage()
    {
        $posts = Post::all()->load('user', 'category');
        return view('post.manage', compact('posts'));
    }
}
