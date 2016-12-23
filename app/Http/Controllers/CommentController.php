<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use App\Http\Requests;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
    	$this->validate($request, [
    		'content' => 'required|min:5',
    	]);

    	$comment = new Comment($request->all());
    	$comment->post_id = $post->id;
    	$comment->creator_id = 1;
    	$comment->save();

    	return back();
    }
}
