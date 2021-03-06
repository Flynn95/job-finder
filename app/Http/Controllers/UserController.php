<?php

namespace App\Http\Controllers;

use App\Post;
use App\Role;
use App\User;
use App\Comment;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function viewManagePage()
    {
    	$users = User::orderBy('id', 'DESC')->paginate(10);
    	$lists = Role::lists('display_name','id');
    	return view('admin.userManage', compact('users', 'lists'));
    }

    public function update(Request $request, User $user)	
    {
    	$this->validate($request, [
    		'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'role' => 'required'
    	]);
    	
    	$user->update($request->all());

    	DB::table('role_user')->where('user_id', $user->id)->delete();
        $user->attachRole($request->input('role'));

		Session::flash('message', 'User updated successfully.');
		return back();
    }

    public function delete(User $user)
    {
    	$posts = $user->posts;
    	$comments = $user->comments;

    	if (count($posts) > 0) {
    		foreach ($posts as $post) {
    			Post::destroy($post->id);
    		}
    	}
    	if (count($comments) > 0) {
	    	foreach ($comments as $comment) {
	    		Comment::destroy($comment->id);
	    	}
	    }

    	User::destroy($user->id);
    	Session::flash('message', 'User deleted successfully.');
		return back();
    }
}
