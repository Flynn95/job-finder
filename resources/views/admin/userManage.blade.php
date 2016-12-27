@extends('layout')

@section('header')
	<title>User manage - Job-Finder.net</title>
@endsection

@section('content')
	<div class="container">
		<h1>
			User manage
		</h1>
		<h4><small><a href="/admin">&larr; back to Summary</a></small></h4>
		<hr>

		<div class="row">
			<div class="col-sm-3">
				<h4>Navigation</h4>
				<ul class="nav nav-pills nav-stacked">
			        <li><a href="/admin">Summary</a></li>
			        <li><a href="/admin/post/manage">Post Manage</a></li>
			        <li class="active"><a href="/admin/user/manage">User Manage</a></li>
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

		<h3>List of all users:</h3>
		<table class="table table-hover">
		    <thead>
		      <tr>
		        <th>ID</th>
		        <th>Name</th>
		        <th>E-mail</th>
		        <th>Role</th>
		        <th>Operation</th>
		      </tr>
		    </thead>
		    <tbody>
			    @foreach($users as $user)
			    	<tr>
			    		<td>{{ $user->id }}</td>
			    		<td>{{ $user->name }}</td>
			    		<td>{{ $user->email }}</td>
			    		<td>{{ $user->roles[0]->display_name }}</td>
			    		<td><p style="display: inline;"><a href="#editModal" data-toggle="modal" data-user-id="{{ $user->id }}" data-user-name="{{ $user->name }}" data-user-email="{{ $user->email }}" data-user-role="{{ $user->roles[0]->id }}">Edit</a> | <a href="#deleteModal" data-toggle="modal" data-user-id="{{ $user->id }}">Delete</a></p></td>
			    	</tr>
			    @endforeach
		    </tbody>
		</table>

		<div id="editModal" class="modal fade" role="dialog">
			<div class="modal-dialog">
			    <!-- Modal content-->
			    <div class="modal-content">
			    <form method="POST" action="admin/post/manage/delete" name="editForm">
				    <div class="modal-header">
				        <h4 class="modal-title">Edit User</h4>
				    </div>
				    <div class="modal-body form-group">
				        <label for="name">Name</label>
				        <input type="text" name="name" class="form-control">
				    </div>
				    <div class="modal-body form-group">
				        <label for="email">E-mail</label>
				        <input type="text" name="email" class="form-control">
				    </div>
				    <div class="modal-body form-group">
				        <label for="role">Role</label>
				        <select class="form-control" name="role">
				        	@foreach($lists as $id => $display_name)
				        		<option value="{{ $id }}">{{ $display_name }}</option>
				        	@endforeach
				        </select>
				    </div>
				    <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				        <button type="submit" class="btn btn-primary">Save</button>
				    </div>
				    {{ csrf_field() }}
				</form>
			    </div>
			</div>
		</div>

		<div id="deleteModal" class="modal fade" role="dialog">
			<div class="modal-dialog">
			    <!-- Modal content-->
			    <div class="modal-content">
			    <form method="POST" action="admin/post/manage/delete" name="deleteForm">
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
		$('#editModal').on('show.bs.modal', function(e) {
	    	var userId = $(e.relatedTarget).data('user-id');
	    	var userName = $(e.relatedTarget).data('user-name');
	    	var userEmail = $(e.relatedTarget).data('user-email');
	    	var userRole = $(e.relatedTarget).data('user-role');
	    	$(e.currentTarget).find('input[name="name"]').val(userName);
	    	$(e.currentTarget).find('input[name="email"]').val(userEmail);
	    	$(e.currentTarget).find('option[value="' + userRole + '"]').attr("selected","selected");
	    	$(e.currentTarget).find('form[name="editForm"]').attr('action', '/admin/user/manage/' + userId + '/update');
		});

		$('#deleteModal').on('show.bs.modal', function(e) {
	    	var userId = $(e.relatedTarget).data('user-id');
	    	var info = 'Are you sure you want to delete this user?';
	    	$(e.currentTarget).find('p[name="postInfo"]').html(info);
	    	$(e.currentTarget).find('form[name="deleteForm"]').attr('action', '/admin/user/manage/' + userId + '/delete');
		});
	</script>
@endsection