@extends('layout')

@section('header')
	<title>Create a new job post - Job-Finder.net</title>
	<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
@endsection

@section('content')
	<div class="container">
		<h1>
			Create a new job post
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

		<form class="form-horizontal" method="POST" action="/post/create/new">
			<div class="form-group">
				<label class="control-label col-sm-2" for="title">Title</label>
				<div class="col-sm-10">
					<input type="text" name="title" class="form-control" size="150" value="{{ old('title') }}" autofocus>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="title">Category</label>
				<div class="col-sm-10">
					<select class="form-control" name="category_id">
						@foreach($categories as $category)
							@if(old('category_id') == $category->id)
							<option value="{{ $category->id }}" selected>{{ $category->name }}</option>
							@else
							<option value="{{ $category->id }}">{{ $category->name }}</option>
							@endif
						@endforeach
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="location">Location</label>
				<div class="col-sm-10">
					<input type="text" name="location" class="form-control" size="150" value="{{ old('location') }}">
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
					<button type="submit" class="form-control btn btn-primary">Submit</button>
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
        	$('#summernote').summernote({
        		height: 300
        	});
    	});
    	var postForm = function() {
			var content = $('textarea[name="content"]').html($('#summernote').code());
		}

		$('#summernote').summernote('editor.pasteHTML', '{!! old('content') !!}');
	</script>
@endsection