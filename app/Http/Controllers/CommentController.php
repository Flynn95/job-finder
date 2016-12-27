<?php

namespace App\Http\Controllers;

use DB;
use App\Post;
use App\Comment;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
    	$this->validate($request, [
    		'content' => 'required|min:5',
    	]);

    	$comment = new Comment($request->all());
    	$comment->post_id = $post->id;
    	$comment->user_id = Auth::user()->id;
    	$comment->save();

    	return back();
    }

    public function manage()
    {
        $comments = Comment::simplePaginate(10);
        return view('admin.commentManage', compact('comments'));
    }

    public function delete(Comment $comment)
    {
        Comment::destroy($comment->id);
        Session::flash('message', 'Comment deleted successfully.');
        return back();
    }
}
