@extends('layouts.admin')

@section('content')
    <div class="jumbotron">
        <h1>Publisher Update</h1>
        <br>
    </div>

    <br>

    <div class="container">
        <h3 class="text-center"><b>Update</b></h3>
        <form method="POST" action="{{route('admin.publishers.update', $publisher->slug)}}">
            @csrf
            <div class="form-group">
                <label>Title</label>
                <input type="text" class="form-control" name="title" value="{{$publisher->title}}">
            </div>
            <!--For publisher Account-->
            <p style="font-size: 20px; text-align: center">For Publisher Account</p>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email" value="{{$publisher->email}}">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="text" class="form-control" name="password" value="{{$publisher->password}}">
            </div>
            <div class="form-group">
                <label>Phone Number:</label>
                <input type="text" class="form-control" name="phone" value="{{$publisher->phone}}">
            </div>
            <button type="submit" class="btn btn-warning btn-block">Update</button>
        </form>
    </div>


@endsection
