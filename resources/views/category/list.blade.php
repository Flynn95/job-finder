@extends('layout')

@section('header')
	<title>All categories - Job-Finder.net</title>
	<style type="text/css">
        body { padding-top: 70px; }
    </style>
@endsection

@section('navigator')
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
              <a class="navbar-brand" href="/">Job-Finder.net</a>
            </div>
            <ul class="nav navbar-nav">
              	<li><a href="/">Home</a></li>
              	<li><a href="/posts">All Jobs</a></li>
              	<li class="active"><a href="/categories">Categories</a></li>
              	@if (Auth::check())
	            	@if (Auth::user()->roles[0]->name == 'employer')
	                    <li><a href="/post/create">Create Job Post</a></li>
	              	@endif
              	@endif
            </ul>
            <ul class="nav navbar-nav navbar-right">
            @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
            @else
                @if (Auth::user()->roles[0]->name == 'admin')
                    <li><button class="btn btn-danger navbar-btn" onclick="window.location.href='/admin'">Admin Panel</button></li>
                @endif
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        <span class="glyphicon glyphicon-user" style="margin-right: 5px;"></span> {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                    </ul>
                </li>
            @endif
            </ul>
        </div>
    </nav>
@endsection

@section('content')
	<div class="container">
		<h1>
			All categories
		</h1>
		<h4><small><a href="/">&larr; back to homepage</a></small></h4>
		<hr>

		<h3>List of all categories available:</h3>
		<div class="list-group">
		    @foreach($categories as $category)
		    	<a href="/categories/{{ $category->id }}" class="list-group-item">{{ $category->name }} <span class="badge">{{ count($category->posts) }}</a>
		    @endforeach
		</div>
	</div>
@endsection