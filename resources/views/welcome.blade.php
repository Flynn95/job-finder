@extends('layout')

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
