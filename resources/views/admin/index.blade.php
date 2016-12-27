@extends('layout')

@section('header')
	<title>Admin panel - Job-Finder.net</title>
	<style>
    	.row.content {height: 1500px}

    	span.info {
    		display: inline-block;
		    font-size: 70px;
    	}

    	div.block {
    		text-align: center;
    		padding: 50px 10px;
    	}
    </style>
@endsection

@section('content')
	<div class="container">
		<h1>Admin Panel</h1>
		<h4><small><a href="/">&larr; back to homepage</a></small></h4>
		<hr>

		<div class="row">
			<div class="col-sm-3">
				<h4>Navigation</h4>
				<ul class="nav nav-pills nav-stacked">
			        <li class="active"><a href="/admin">Summary</a></li>
			        <li><a href="/admin/post/manage">Post Manage</a></li>
			        <li><a href="/admin/user/manage">User Manage</a></li>
			        <li><a href="/admin/comment/manage">Comment Manage</a></li>
			        <li><a href="/admin/category/manage">Category Manage</a></li>

			    </ul>
		    </div>

		    <div class="col-sm-9">
		    	<h4><small>SITE SUMMARY</small></h4>
      			<hr>
      			<div class="row">
	      			<div class="col-sm-6 block">
	      				<span class="info">{{ count($posts) }}</span>
	      				<br />
	      				<span>Posts</span>
	      			</div>
	      			<div class="col-sm-6 block">
	      				<span class="info">{{ count($categories) }}</span>
	      				<br />
	      				<span>Categories</span>
	      			</div>
	      		</div>
	      		<div class="row">
	      			<div class="col-sm-6 block">
	      				<span class="info">{{ count($comments) }}</span>
	      				<br />
	      				<span>Comments</span>
	      			</div>
	      			<div class="col-sm-6 block">
	      				<span class="info">{{ count($users) }}</span>
	      				<br />
	      				<span>Users</span>
	      			</div>
	      		</div>
		    </div>
		</div>

	</div>
@endsection