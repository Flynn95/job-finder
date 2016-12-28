@extends('layout')

@section('header')
    <title>Register - Job-Finder.net</title>
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
        <h1>
            Register
        </h1>
        <h4><small><a href="/">&larr; back to homepage</a></small></h4>
        <hr>

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

        <form class="form-horizontal" method="POST" action="/register">
            <div class="form-group">
                <label class="control-label col-sm-2" for="name">Name</label>
                <div class="col-sm-10">
                    <input type="text" name="name" class="form-control" size="150" autofocus>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">E-mail</label>
                <div class="col-sm-10">
                    <input type="email" name="email" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="role">Role</label>
                <div class="col-sm-10">
                    <select class="form-control" name="role">
                            <option value="2">Employer</option>
                            <option value="3">Employee</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="password">Password</label>
                <div class="col-sm-10">
                    <input type="password" name="password" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="password-confirm">Confirm password</label>
                <div class="col-sm-10">
                    <input type="password" name="password-confirm" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-2"></div>
                <div class="col-sm-10">
                    <button type="submit" class="form-control btn btn-primary">Submit</button>
                </div>
            </div>
            {{ csrf_field() }}
        </form>

    </div>
@endsection
