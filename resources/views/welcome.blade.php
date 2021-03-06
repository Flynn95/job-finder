@extends('layout')

@section('header')
    <title>Home page - Job-Finder.net</title>
    <style type="text/css">
        body { padding-top: 70px; }

        .form-group {
            margin-bottom: 0px;
        }

        .carousel-inner{
            width:100%;
            max-height: 500px !important;
        }

        .carousel {
            position: absolute;
        }

        .outside {
            display: flex;
            height: 500px;
            width: 100%;
            align-items: center;
        }

        .inside {
            height: 100%;
            z-index: 1;
            margin-top: 35%;
        }

        .navbar-brand {
            padding: 0px 15px;
        }
    </style>
@endsection

@section('navigator')
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="/">
                    <img src="/img/logo.png" alt="logo">
                </a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="/">Home</a></li>
                <li><a href="/posts">All Jobs</a></li>
                <li><a href="/categories">Categories</a></li>
                @if (Auth::check())
                    @if (Auth::user()->roles[0]->name == 'employer')
                        <li><a href="/post/create">Create Job Post</a></li>
                    @endif
                @endif
            </ul>
            <ul class="nav navbar-nav navbar-right">
            @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
            @else
                @if (Auth::user()->roles[0]->name == 'admin')
                    <li><button class="btn btn-danger navbar-btn" onclick="window.location.href='/admin'">Admin Panel</button></li>
                @endif
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
        {{-- <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
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
        </div> --}}
        <div class="col-md-12 outside">
            <div class="col-md-10 col-md-offset-1 inside">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form method="POST" action="/search">
                            <div class="form-group">
                                <div class="col-xs-3" style="padding: 5px; ">
                                    <input type="text" class="form-control" name="query" placeholder="Job Title, Skills">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-3" style="padding: 5px; ">
                                    <select class="form-control" name="category_id">
                                        <option value="all">All Categories</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-2" style="padding: 5px; ">
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
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            {{-- <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
                <li data-target="#myCarousel" data-slide-to="3"></li>
            </ol> --}}

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src="img/001.jpg" alt="cityscape1">
                </div>

                <div class="item">
                    <img src="img/002.jpg" alt="cityscape2">
                </div>

                <div class="item">
                    <img src="img/003.jpg" alt="cityscape3">
                </div>

                <div class="item">
                    <img src="img/004.jpg" alt="cityscape4">
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
