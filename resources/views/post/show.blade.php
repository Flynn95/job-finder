@extends('layout')

@section('header')
	<title>{{ $post->title }} by {{ $post->user->name }} - Job-Finder.net</title>
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
              	<li><a href="/categories">Categories</a></li>
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
		<!-- Post header section -->
		<h1>{{ $post->title }} <small style="font-size: 50%; ">published by {{ $post->user->name }}</small></h1>
		<p>In <strong>{{ $post->category->name }}</strong>, <i>published {{ $post->created_at->diffForHumans() }}, updated {{ $post->updated_at->diffForHumans() }}</i> | Location: {{ $post->location }}</p>
		<h4><small><a href="/posts">&larr; back to jobs list</a></small></h4>
		<hr>
			<!-- Contents section -->
			{!! $post->content !!}
		<hr>
		<!-- Comments section -->
		<table class="table">
			<tbody>
				@foreach($post->comments as $comment)
				<tr>
					<td><strong>{{ $comment->user->name }}</strong></br>
						{{ $comment->content }}
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>

		@if(count($errors) > 0)
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
					    <li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
		@if (Auth::check())
			<form method="POST" action="/comment/{{ $post->id }}/new">
				<div class="form-group">
					<textarea class="form-control" name="content" style="min-height: 80px; ">{{ old('content') }}</textarea>
				</div>
				<div class="form-group">
					<button type="submit" class="form-control btn btn-primary">Post your comment</button>
				</div>
				{{ csrf_field() }}
			</form>
		@endif
	</div>
@endsection