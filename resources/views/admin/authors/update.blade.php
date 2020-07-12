@extends('layouts.admin')

@section('content')
    <div class="jumbotron">
        <h1>Author Update</h1>
        <br>
    </div>

    <br>

    <div class="container">
        <h3 class="text-center"><b>Update</b></h3>
        <form method="POST" action="{{route('admin.authors.update', $author[0]->slug)}}">
            @csrf
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name" value="{{$author[0]->name}}">
            </div>
            <div class="form-group">
                <label>Slug</label>
                <input type="text" class="form-control" name="slug" value="{{$author[0]->slug}}">
            </div>
            <button type="submit" class="btn btn-warning btn-block">Update</button>
        </form>
    </div>


@endsection