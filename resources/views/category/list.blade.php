@extends('layout')

@section('header')
	<title>All categories - Job-Finder.net</title>
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