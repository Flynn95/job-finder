@extends('layout')

@section('header')
	<title>Edit post #{{ $post->id }} - Job-Finder.net</title>
	<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
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
            	@if (Auth::user()->roles[0]->name == 'employer')
                    <li><a href="/post/create">Create Job Post</a></li>
              	@endif
            </ul>
            <ul class="nav navbar-nav navbar-right">
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
            </ul>
        </div>
    </nav>
@endsection

@section('content')
	<div class="container">
		<h1>
			Editing post #{{ $post->id }}:<br />
			<small style="font-size: 50%; ">{{ $post->title }}</small>
		</h1>
		<h4><small><a href="/">&larr; back to homepage</a></small></h4>
		<hr>

		@if(count($errors) > 0)
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
					    <li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif

		@if(\Session::has('message'))
			<div class="alert alert-success">{{ \Session::get('message') }}</div>
		@endif

		<form class="form-horizontal" method="POST" action="/post/{{ $post->id }}/update">
			{{ method_field('PATCH') }}
			<div class="form-group">
				<label class="control-label col-sm-2" for="title">Title</label>
				<div class="col-sm-10">
					<input type="text" name="title" class="form-control" size="150" value="{{ $post->title }}">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="title">Category</label>
				<div class="col-sm-10">
					<select class="form-control" name="category_id">
						@foreach($categories as $category)
							@if($category->id == $post->category_id)
								<option value="{{ $category->id }}" selected>{{ $category->name }}</option>
							@else
								<option value="{{ $category->id }}">{{ $category->name }}</option>
							@endif
						@endforeach
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="title">Post content</label>
				<div class="col-sm-10">
					<textarea class="form-control" id="summernote" name="content"></textarea>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-2"></div>
				<div class="col-sm-10">
					<button type="submit" class="form-control btn btn-primary">Update</button>
				</div>
			</div>
			{{ csrf_field() }}
		</form>

		<form class="form-horizontal" method="POST" action="/post/{{ $post->id }}/delete">
			<div class="form-group">
				<div class="col-sm-2"></div>
				<div class="col-sm-10">
					<button type="submit" class="form-control btn btn-danger">Delete</button>
				</div>
			</div>
			{{ csrf_field() }}
		</form>

	</div>
@endsection

@section('afterscript')
	<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>
	<script>
		$(document).ready(function() {
        	$('#summernote').summernote('editor.pasteHTML', '{!! $post->content !!}');
    	});

    	var postForm = function() {
			var content = $('textarea[name="content"]').html($('#summernote').code());
		}
	</script>
@endsection