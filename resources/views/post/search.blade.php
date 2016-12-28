@extends('layout')

@section('header')
	<title>Search results for "{{ $query }}" - Job-Finder.net</title>
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
            </ul>
            <ul class="nav navbar-nav navbar-right">
            @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
            @else
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
