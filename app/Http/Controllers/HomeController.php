<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('welcome', compact('categories'));
    }
}
