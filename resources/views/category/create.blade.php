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

		@if(\Session::has('message'))
			<div class="alert alert-success">{{ \Session::get('message') }}</div>
		@endif

		@if(\Session::has('err-message'))
			<div class="alert alert-warning">{{ \Session::get('err-message') }}</div>
		@endif

		<h3>List of all current category:</h3>
		<ul class="list-group">
		    @foreach($categories as $category)
		    	<li class="list-group-item">{{ $category->name }} <a href="#myModal" data-toggle="modal" data-cat-id="{{ $category->id }}" data-cat-name="{{ $category->name }}" class="pull-right">Delete</a></li>
		    @endforeach
		</ul>

		<div id="myModal" class="modal fade" role="dialog">
			<div class="modal-dialog">
			    <!-- Modal content-->
			    <div class="modal-content">
			    <form method="POST" action="category/manage/delete" name="modalForm">
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

		@if(count($errors) > 0)
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
					    <li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
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

@section('afterscript')
	<script>
		$('#myModal').on('show.bs.modal', function(e) {
	    	var catId = $(e.relatedTarget).data('cat-id');
	    	var catName = $(e.relatedTarget).data('cat-name');
	    	var info = 'Are you sure you want to delete the <strong>' + catName + '</strong> category?<br />All post under this category will be put into General category.';
	    	$(e.currentTarget).find('p[name="catInfo"]').html(info);
	    	$(e.currentTarget).find('form[name="modalForm"]').attr('action', '/category/manage/' + catId + '/delete');
		});
	</script>
@endsection