<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use App\Comment;
use App\Category;
use App\Http\Requests;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
    	$posts = Post::all();
    	$users = User::all();
    	$comments = Comment::all();
    	$categories = Category::all();
    	return view('admin.index', compact('posts', 'users', 'comments', 'categories'));
    }
}
