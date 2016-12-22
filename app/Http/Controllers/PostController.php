<?php

namespace App\Http\Controllers;

use App\Post;
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
}
