@extends('layout')

@section('header')
    <title>Home page - Job-Finder.net</title>
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
              <li class="active"><a href="/">Home</a></li>
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
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                {{-- <div class="panel-heading">Find your Perfect Job</div> --}}

                <div class="panel-body">
                    <form method="POST" action="/search">
                        <div class="form-group">
                            <div class="col-xs-4" style="padding: 5px; ">
                                <input type="text" class="form-control" name="query" placeholder="Job Title, Skills">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-4" style="padding: 5px; ">
                                <select class="form-control" name="category_id">
                                    <option value="all">All Categories</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-3" style="padding: 5px; ">
                                <input type="text" class="form-control" name="location" placeholder="Location">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-1" style="padding: 5px; ">
                                <button type="submit" class="form-control btn btn-primary">Submit</button>
                            </div>
                        </div>
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
