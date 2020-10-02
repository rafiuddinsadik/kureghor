@extends('layouts.admin')

@section('content')
    <div class="container">
        @if (\Session::has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error! </strong>{!! \Session::get('error') !!}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="jumbotron">
            <h1>Active Publisher List</h1>
            <!-- Button trigger modal -->
            <a type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter">
                Create
            </a>

            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Create a new category!</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{route('admin.publishers.add')}}">
                                @csrf
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control" name="title">
                                </div>
                                <div class="form-group">
                                    <label>Slug</label>
                                    <input type="text" class="form-control" name="slug">
                                </div>
                                <!--For publisher Account-->
                                <p style="font-size: 20px; text-align: center">For Publisher Account</p>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="text" class="form-control" name="password">
                                </div>
                                <div class="form-group">
                                    <label>Phone Number:</label>
                                    <input type="text" class="form-control" name="phone">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit & Create Account</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br>

        <h3 class="text-center"><b>List</b></h3>
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Slug</th>
                <th scope="col">Book Count</th>
                <th scope="col">Created At</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Password</th>
                <th scope="col">Update</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
            @if(count($publishers) && !empty($publishers))
                @foreach($publishers as $publisher)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$publisher->title}}</td>
                        <td>{{$publisher->slug}}</td>
                        <td>0</td>
                        <td>{{$publisher->created_at->diffForHumans()}}</td>
                        <td>{{$publisher->email}}</td>
                        <td>{{$publisher->phone}}</td>
                        <td>{{$publisher->password}}</td>
                        <td><a href="#" class="btn btn-warning">Update</a></td>
                        <td><a href="#" class="btn btn-danger">Delete</a></td>
                    </tr>
            @endforeach
            @endif
        </table>
    </div>
@endsection