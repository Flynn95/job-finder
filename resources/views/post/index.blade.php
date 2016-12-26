@extends('layout')

@section('header')
	<title>All available jobs - Job-Finder.net</title>
@endsection

@section('content')
	<div class="container">
		<h1>All available jobs</h1>
		<div class="row">

			@if(\Session::has('message'))
				<div class="alert alert-success">{{ \Session::get('message') }}</div>
			@endif

			<table class="table table-hover">
				<tbody>
					@foreach($posts as $post)
					<tr>
						<td>
							<h4><a href="/show/{{ $post->id }}">{{ $post->title }}</a></h4>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection