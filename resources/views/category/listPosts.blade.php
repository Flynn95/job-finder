@extends('layout')

@section('header')
	<title>All posts in category "{{ $category->name }}" - Job-Finder.net</title>
@endsection

@section('content')
	<div class="container">
		<h1>
			All posts in category "{{ $category->name }}"
		</h1>
		<h4><small><a href="/categories">&larr; back to categories listing</a></small></h4>
		<hr>
		@if(count($posts) > 0)
			<div class="list-group">
			    @foreach($posts as $post)
			    	<a href="/show/{{ $post->id }}" class="list-group-item">{{ $post->title }}</a>
			    @endforeach
			</div>
			{{ $posts->render() }}
		@else
			<p>Nothing to show here.</p>
		@endif
	</div>
@endsection