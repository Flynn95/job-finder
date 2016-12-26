@extends('layout')

@section('header')
	<title>{{ $post->title }} by {{ $post->user->name }} - Job-Finder.net</title>
@endsection

@section('content')
	<div class="container">
		<!-- Post header section -->
		<h1>{{ $post->title }} <small style="font-size: 50%; ">published by {{ $post->user->name }}</small></h1>
		<p>Published {{ $post->created_at->diffForHumans() }}, updated {{ $post->updated_at->diffForHumans() }}</p>
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

		<form method="POST" action="/comment/{{ $post->id }}/new">
			<div class="form-group">
				<textarea class="form-control" name="content" style="min-height: 80px; ">{{ old('content') }}</textarea>
			</div>
			<div class="form-group">
				<button type="submit" class="form-control btn btn-primary">Post your comment</button>
			</div>
			{{ csrf_field() }}
		</form>
	</div>
@endsection