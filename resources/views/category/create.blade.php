@extends('layout')

@section('header')
	<title>Create a new category</title>
@endsection

@section('content')
	<div class="container">
		<h1>
			Create a new category
		</h1>
		<h4><small><a href="/">&larr; back to homepage</a></small></h4>
		<hr>

		<h3>List of all current category:</h3>
		<ul class="list-group">
		    @foreach($categories as $category)
		    	<li class="list-group-item">{{ $category->name }}</li>
		    @endforeach
		</ul>

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

		<form method="POST" action="/category/create/new">
			<div class="form-group">
				<label for="name">Name</label>
				<input type="text" name="name" class="form-control" size="150" autofocus>
			</div>
			<div class="form-group">
					<button type="submit" class="form-control btn btn-primary">Submit</button>
			</div>
			{{ csrf_field() }}
		</form>
@endsection