@extends('layout')

@section('header')
	<title>Comment manage - Job-Finder.net</title>
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
			Comment manage
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
			        <li class="active"><a href="/admin/comment/manage">Comment Manage</a></li>
			        <li><a href="/admin/category/manage">Category Manage</a></li>

			    </ul>
		    </div>

		    <div class="col-sm-9">

		@if(\Session::has('message'))
			<div class="alert alert-success">{{ \Session::get('message') }}</div>
		@endif

		@if(\Session::has('err-message'))
			<div class="alert alert-warning">{{ \Session::get('err-message') }}</div>
		@endif

		<h3>List of all comments:</h3>
		<table class="table table-hover">
		    <thead>
		      <tr>
		        <th>ID</th>
		        <th>User</th>
		        <th>Post</th>
		        <th>Content</th>
		        <th>Operation</th>
		      </tr>
		    </thead>
		    <tbody>
			    @foreach($comments as $comment)
			    	<tr>
			    		<td>{{ $comment->id }}</td>
			    		<td>{{ $comment->user->name }}</td>
			    		<td>{{ $comment->post->title }}</td>
			    		<td>{{ $comment->content }}</td>
			    		<td><a href="#myModal" data-toggle="modal" data-comment-id="{{ $comment->id }}">Delete</a></td>
			    	</tr>
			    @endforeach
		    </tbody>
		</table>

		<div id="myModal" class="modal fade" role="dialog">
			<div class="modal-dialog">
			    <!-- Modal content-->
			    <div class="modal-content">
			    <form method="POST" action="/admin/comment/manage/delete" name="modalForm">
				    <div class="modal-header">
				        <h4 class="modal-title">Confirmation</h4>
				    </div>
				    <div class="modal-body">
				        <p name="postInfo"></p>
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

		@if(count($errors) > 0)
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
					    <li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif

		{{ $comments->render() }}
		</div>
		</div>
		</div>
@endsection

@section('afterscript')
	<script>
		$('#myModal').on('show.bs.modal', function(e) {
	    	var commentId = $(e.relatedTarget).data('comment-id');
	    	var info = 'Are you sure you want to delete this comment?';
	    	$(e.currentTarget).find('p[name="postInfo"]').html(info);
	    	$(e.currentTarget).find('form[name="modalForm"]').attr('action', '/admin/comment/manage/' + commentId + '/delete');
		});
	</script>
@endsection