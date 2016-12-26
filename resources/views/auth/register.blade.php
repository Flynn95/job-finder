@extends('layout')

@section('header')
    <title>Register - Job-Finder.net</title>
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
                            <option value="employer">Employer</option>
                            <option value="employee">Employee</option>
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
