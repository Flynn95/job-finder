@extends('layout')

@section('header')
	<title>{{ $post->title }} - Job-Finder.net</title>
@endsection

@section('content')
	<div class="container">
		<!-- Post header section -->
		<h1>{{ $post->title }} <small style="font-size: 50%; ">published by {{ $post->user->name }}</small></h1>
		<h4><small><a href="/list">&larr; back to list</a></small></h4>
		<hr>
			<!-- Post contents section -->
			<p>
				{{ $post->content }}
			</p>
		<hr>
			<!-- Post comments section -->
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
	</div>
@endsection