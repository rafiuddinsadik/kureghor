@extends('layouts.admin')

@section('content')
    <div class="jumbotron">
        <h1>Category Update</h1>
        <br>
    </div>

    <br>

    <div class="container">
        <h3 class="text-center"><b>Update</b></h3>
        <form method="POST" action="{{route('admin.categories.update', $category[0]->slug)}}">
            @csrf
            <div class="form-group">
                <label>Title</label>
                <input type="text" class="form-control" name="title" value="{{$category[0]->title}}">
            </div>
            <div class="form-group">
                <label>Slug</label>
                <input type="text" class="form-control" name="slug" value="{{$category[0]->slug}}">
            </div>
            <button type="submit" class="btn btn-warning btn-block">Update</button>
        </form>
    </div>


@endsection