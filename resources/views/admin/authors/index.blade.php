@extends('layouts.admin')

@section('content')
    <div class="jumbotron" style="text-align: center">
        <h1>Author List</h1>
        <br>
        <!-- Button trigger modal -->
        <a type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter">
            Create
        </a>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Create a new author!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{route('admin.authors.add')}}">
                            @csrf
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <div class="form-group">
                                <label>Slug</label>
                                <input type="text" class="form-control" name="slug">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="container">
        <h3 class="text-center"><b>List</b></h3>
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Slug</th>
                <th scope="col">Book Count</th>
                <th scope="col">Created At</th>
                <th scope="col">Update</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
            @if(count($authors) && !empty($authors))
                @foreach($authors as $author)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$author->name}}</td>
                        <td>{{$author->slug}}</td>
                        <td>0</td>
                        <td>{{$author->created_at->diffForHumans()}}</td>
                        <td><a href="{{route('admin.authors.modify', $author->slug)}}" class="btn btn-warning">Update</a></td>
                        <td><a href="{{route('admin.authors.delete', $author->slug)}}" class="btn btn-danger">Delete</a></td>
                    </tr>
            @endforeach
            @endif
        </table>
    </div>


@endsection