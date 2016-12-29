<?php

namespace App\Http\Controllers;

use Session;
use App\Post;
use App\Role;
use App\User;
use App\Comment;
use App\Category;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
	/**
	 * List all post from database
	 * @return Laravel view
	 */
    public function list()
    {
    	$posts = Post::orderBy('id', 'DESC')->paginate(10);
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
            'category_id' => 'required',
    		'content' => 'required|min:30'
    	]);

    	$post = new Post($request->all());
    	$post->user_id = Auth::user()->id;
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
        if (Auth::user()->id == $post->user_id) {
            $categories = Category::all();
            return view('post.edit', compact('post', 'categories'));
        }
        else {
            return view('errors.403');
        }
    }
    public function editFromManage(Post $post)
    {
        $categories = Category::all();
        return view('admin.editPost', compact('post', 'categories'));
    }

    /**
     * Update post
     * @param  Request $request
     * @param  Post    $post    
     * @return Redirect
     */
    public function update(Request $request, Post $post)
    {
        if (Auth::user()->id == $post->user_id) {
        	$post->update($request->all());

        	Session::flash('message', 'Your post has been updated successfully.');
        	return back();
        }
        else {
            return view('errors.403');
        }
    }
    public function updateFromManage(Request $request, Post $post)
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
        if (Auth::user()->id == $post->user_id) {
            $comments = $post->comments;
            if (count($comments) > 0) {
                foreach ($comments as $comment) {
                    Comment::destroy($comment->id);
                }
            }

        	Post::destroy($post->id);
            Session::flash('message', 'Post deleted successfully.');
        	return redirect('/posts');
        }
        else {
            return view('errors.403');
        }
    }
    public function deleteFromManage(Post $post)
    {
        $comments = $post->comments;
        foreach ($comments as $comment) {
            Comment::destroy($comment->id);
        };

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
        $posts = Post::paginate(10);
        return view('admin.postManage', compact('posts'));
    }

    public function viewAllUserPosts(User $user)
    {
        $user->load('posts');
        return view('user.allposts', compact('user'));
    }

    public function search(Request $request)
    {
        $this->validate($request, [
            'query' => 'required|min:3',
            'category_id' => 'required',
        ]);
        $query = $request->input('query');

        if ($request->input('location') == '' && $request->input('category_id') != 'all') {
            $results = Post::where('category_id', $request->input('category_id'))
                    ->search($query)
                    ->paginate('10');
        } else if ($request->input('location') == '' && $request->input('category_id') == 'all') {
            $results = Post::search($query)
                    ->paginate('10');
        } else if ($request->input('location') != '' && $request->input('category_id') != 'all') {
            $results = Post::where([
                        ['category_id', $request->input('category_id')],
                        ['location', $request->input('location')]
                    ])
                    ->search($query)
                    ->paginate('10');
        } else if ($request->input('location') != '' && $request->input('category_id') == 'all') {
            $results = Post::where('location', $request->input('location'))
                    ->search($query)
                    ->paginate('10');
        }

        return view('post.search', compact('results', 'query'));
    }
}
