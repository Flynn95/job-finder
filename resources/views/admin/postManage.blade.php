@extends('layout')

@section('header')
	<title>Post manage - Job-Finder.net</title>
@endsection

@section('content')
	<div class="container">
		<h1>
			Post manage
		</h1>
		<h4><small><a href="/admin">&larr; back to Summary</a></small></h4>
		<hr>

		<div class="row">
			<div class="col-sm-3">
				<h4>Navigation</h4>
				<ul class="nav nav-pills nav-stacked">
			        <li><a href="/admin">Summary</a></li>
			        <li class="active"><a href="/admin/post/manage">Post Manage</a></li>
			        <li><a href="/admin/user/manage">User Manage</a></li>
			        <li><a href="/admin/comment/manage">Comment Manage</a></li>
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

		<h3>List of all posts:</h3>
		<table class="table table-hover">
		    <thead>
		      <tr>
		        <th>ID</th>
		        <th>Title</th>
		        <th>User</th>
		        <th>Content</th>
		        <th>Operation</th>
		      </tr>
		    </thead>
		    <tbody>
			    @foreach($posts as $post)
			    	<tr>
			    		<td>{{ $post->id }}</td>
			    		<td><a href="/show/{{ $post->id }}">{{ str_limit($post->title, 25) }}</a></td>
			    		<td>{{ $post->user->name }}</td>
			    		<td>{{ str_limit($post->content, 100) }}</td>
			    		<td><p style="display: inline;"><a href="/admin/post/manage/{{ $post->id }}/edit">Edit</a> | <a href="#myModal" data-toggle="modal" data-post-id="{{ $post->id }}">Delete</a></p></td>
			    	</tr>
			    @endforeach
		    </tbody>
		</table>

		{{-- <ul class="list-group">
		    @foreach($posts as $post)
		    	<li class="list-group-item">{{ $post->title }} <p style="display: inline;" class="pull-right"><a href="/post/manage/{{ $post->id }}/edit">Edit</a> | <a href="#myModal" data-toggle="modal" data-post-id="{{ $post->id }}">Delete</a></p></li>
		    @endforeach
		</ul> --}}

		<div id="myModal" class="modal fade" role="dialog">
			<div class="modal-dialog">
			    <!-- Modal content-->
			    <div class="modal-content">
			    <form method="POST" action="admin/post/manage/delete" name="modalForm">
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

		</div>
		</div>
		</div>
		
@endsection

@section('afterscript')
	<script>
		$('#myModal').on('show.bs.modal', function(e) {
	    	var postId = $(e.relatedTarget).data('post-id');
	    	var info = 'Are you sure you want to delete this post?';
	    	$(e.currentTarget).find('p[name="postInfo"]').html(info);
	    	$(e.currentTarget).find('form[name="modalForm"]').attr('action', '/admin/post/manage/' + postId + '/delete');
		});
	</script>
@endsection