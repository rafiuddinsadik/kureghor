@extends('layouts.publisher')

@section('content')
    @if (\Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success! </strong>{!! \Session::get('success') !!}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="jumbotron" style="text-align: center">
        <h1>Book List</h1>
        <br>
        <!-- Button trigger modal -->
        <a href="{{route('publisher.book.create')}}" class="btn btn-success">
            Create
        </a>
    </div>

    <br>

    <div class="container">
        <h3 class="text-center"><b>List</b></h3>
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Author</th>
                <th scope="col">Category</th>
                <th scope="col">Price</th>
                <th scope="col">Discounted Price</th>
                <th scope="col">Total Sell</th>
                <th scope="col">View</th>
                <th scope="col">Created</th>
                <th scope="col">Status</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
            @if(count($books) && !empty($books))
                @foreach($books as $book)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$book->title}}</td>
                        <td>
                            @foreach ($book->authors as $author)
                                <span class="badge badge-pill badge-success">{{$author->name}}</span>
                            @endforeach
                        </td>
                        <td>
                            @foreach ($book->categories as $category)
                                <span class="badge badge-pill badge-primary">{{$category->title}}</span>
                            @endforeach
                        </td>
                        <td>{{$book->price}}</td>
                        <td>{{$book->discount_price}}</td>
                        <td>{{$book->total_sell}}</td>
                        <td>{{$book->viewer}}</td>
                        <td>{{$book->created_at->diffForHumans()}}</td>
                        @if($book->status == 2)
                            <td><span style="color: orange; font-weight: bold">Pending</span></td>
                        @else
                            <td><span style="color: green; font-weight: bold">Active</span></td>
                        @endif
                        @if($book->status == 2)
                            <td><a href="{{route('publisher.book.delete', $book->id)}}" onclick="return confirm('Are you sure?');" class="btn btn-danger">Delete</a></td>
                        @else
                            <td><a href="#" class="btn btn-danger disabled">Delete</a></td>
                        @endif
                    </tr>
            @endforeach
            @endif
        </table>
    </div>
    <div class="container">
        {{ $books->links() }}
    </div>
@stop

