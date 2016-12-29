@extends('layout')

@section('header')
	<title>Admin Panel - Category Manage</title>
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
			Category Manage
		</h1>
		<h4><small><a href="/admin">&larr; back to Summary</a></small></h4>
		<hr>

		<div class="row">
			<div class="col-sm-3">
				<h4>Navigation</h4>
				<ul class="nav nav-pills nav-stacked">
			        <li><a href="/admin">Summary</a></li>
			        <li><a href="/admin/post/manage">Post Manage</a></li>
			        <li><a href="/admin/user/manage">User Manage</a></li>
			        <li><a href="/admin/comment/manage">Comment Manage</a></li>
			        <li class="active"><a href="/admin/category/manage">Category Manage</a></li>

			    </ul>
		    </div>

		    <div class="col-sm-9">

		@if(\Session::has('message'))
			<div class="alert alert-success">{{ \Session::get('message') }}</div>
		@endif

		@if(\Session::has('err-message'))
			<div class="alert alert-warning">{{ \Session::get('err-message') }}</div>
		@endif

		<h3>List of all current category:</h3>
		<ul class="list-group">
		    @foreach($categories as $category)
		    	<li class="list-group-item">{{ $category->name }} <p style="display: inline; padding-left: 10px;" class="pull-right"><a href="#editModal" data-toggle="modal" data-cat-id="{{ $category->id }}" data-cat-name="{{ $category->name }}">Edit</a> | <a href="#delModal" data-toggle="modal" data-cat-id="{{ $category->id }}" data-cat-name="{{ $category->name }}">Delete</a></p><span class="badge">{{ count($category->posts) }}</span></li>
		    @endforeach
		</ul>

		{{ $categories->render() }}

		<div id="delModal" class="modal fade" role="dialog">
			<div class="modal-dialog">
			    <!-- Modal content-->
			    <div class="modal-content">
			    <form method="POST" action="/admin/category/manage/delete" name="modalDelForm">
				    <div class="modal-header">
				        <h4 class="modal-title">Confirmation</h4>
				    </div>
				    <div class="modal-body">
				        <p name="catInfo"></p>
				    </div>
				    <div class="modal-footer">
				        <button type="submit" class="btn btn-danger">Yes</button>
				        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
				    </div>
				    {{ csrf_field() }}
				</form>
			    </div>
			</div>
		</div>

		<div id="editModal" class="modal fade" role="dialog">
			<div class="modal-dialog">
			    <!-- Modal content-->
			    <div class="modal-content">
			    <form method="POST" action="/admin/category/manage/update" name="modalEditForm">
				    <div class="modal-header">
				        <h4 class="modal-title">Edit category</h4>
				    </div>
				    <div class="modal-body">
				    	<label for="catName">Name</label>
				        <input type="text" class="form-control" name="catName" value="">
				    </div>
				    <div class="modal-footer">
				        <button type="submit" class="btn btn-primary">Update</button>
				        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				    </div>
				    {{ csrf_field() }}
				</form>
			    </div>
			</div>
		</div>

		@if(count($errors) > 0)
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
					    <li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif

		<form method="POST" action="/admin/category/manage/new">
			<div class="form-group">
				<label for="name">New category</label>
				<input type="text" name="name" class="form-control" size="150" autofocus>
			</div>
			<div class="form-group">
					<button type="submit" class="form-control btn btn-primary">Submit</button>
			</div>
			{{ csrf_field() }}
		</form>
		</div>
		</div>
	</div>
@endsection

@section('afterscript')
	<script>
		$('#delModal').on('show.bs.modal', function(e) {
	    	var catId = $(e.relatedTarget).data('cat-id');
	    	var catName = $(e.relatedTarget).data('cat-name');
	    	var info = 'Are you sure you want to delete the <strong>' + catName + '</strong> category?<br />All post under this category will be put into General category.';
	    	$(e.currentTarget).find('p[name="catInfo"]').html(info);
	    	$(e.currentTarget).find('form[name="modalDelForm"]').attr('action', '/admin/category/manage/' + catId + '/delete');
		});

		$('#editModal').on('show.bs.modal', function(e) {
	    	var catId = $(e.relatedTarget).data('cat-id');
	    	var catName = $(e.relatedTarget).data('cat-name');
	    	$(e.currentTarget).find('input[name="catName"]').val(catName);
	    	$(e.currentTarget).find('form[name="modalEditForm"]').attr('action', '/admin/category/manage/' + catId + '/update');
		});
	</script>
@endsection