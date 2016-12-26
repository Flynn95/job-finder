@extends('layout')

@section('header')
	<title>Post manage - Job-Finder.net</title>
@endsection

@section('content')
	<div class="container">
		<h1>
			Post manage
		</h1>
		<h4><small><a href="/">&larr; back to homepage</a></small></h4>
		<hr>

		@if(\Session::has('message'))
			<div class="alert alert-success">{{ \Session::get('message') }}</div>
		@endif

		@if(\Session::has('err-message'))
			<div class="alert alert-warning">{{ \Session::get('err-message') }}</div>
		@endif

		<h3>List of all posts:</h3>
		<ul class="list-group">
		    @foreach($posts as $post)
		    	<li class="list-group-item">{{ $post->title }} <p style="display: inline;" class="pull-right"><a href="/post/manage/{{ $post->id }}/edit">Edit</a> | <a href="#myModal" data-toggle="modal" data-post-id="{{ $post->id }}">Delete</a></p></li>
		    @endforeach
		</ul>

		<div id="myModal" class="modal fade" role="dialog">
			<div class="modal-dialog">
			    <!-- Modal content-->
			    <div class="modal-content">
			    <form method="POST" action="post/manage/delete" name="modalForm">
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
@endsection

@section('afterscript')
	<script>
		$('#myModal').on('show.bs.modal', function(e) {
	    	var postId = $(e.relatedTarget).data('post-id');
	    	var info = 'Are you sure you want to delete this post?';
	    	$(e.currentTarget).find('p[name="postInfo"]').html(info);
	    	$(e.currentTarget).find('form[name="modalForm"]').attr('action', '/post/manage/' + postId + '/delete');
		});
	</script>
@endsection