@extends('layout')

@section('header')
	<title>Search results for "{{ $query }}" - Job-Finder.net</title>
@endsection

@section('content')
	<div class="container">
		<h1>Search results for "{{ $query }}"</h1>
		<h4><small><a href="/">&larr; back to homepage</a></small></h4>
		<hr>
		<div class="row">
			<table class="table table-hover">
				<tbody>
					@foreach($results as $post)
					<tr>
						<td>
							<strong style="font-size: large; "><a href="/show/{{ $post->id }}">{{ $post->title }}</a></strong><br />
							{{ str_limit($post->content, 150) }}
						</td>
						<td>
							<p class="pull-right" style="font-style: italic; ">Published by {{ $post->user->name }}, {{ $post->created_at->diffForHumans() }}</p>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection
