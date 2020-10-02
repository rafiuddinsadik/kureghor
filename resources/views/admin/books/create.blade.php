@extends('layouts.admin')

@section('content')
    <div class="jumbotron" style="text-align: center">
        <h1>Create A New Book</h1>
    </div>

    <br>

    <div class="container">
        <h3 class="text-center"><b>Enter Details</b>
            <hr></h3>

        <form action="{{route('admin.book.add')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Sub Title</label>
                        <input type="text" name="subTitle" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="form-control" rows="3"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>Price</label>
                        <input type="text" name="price" class="form-control">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Discounted Price</label>
                        <input type="text" name="discountedPrice" class="form-control">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Enter current stock</label>
                        <input type="text" name="stock" class="form-control">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Publisher</label>
                        <select id="publisher-multiselect" class="form-control" name="publisher">
                            @foreach($publishers as $publisher)
                                <option value="{{$publisher->id}}">{{$publisher->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>Authors</label>
                        <select class="form-control" id="author-multiselect" name="authors[]" multiple="multiple">
                            @foreach($authors as $author)
                                <option value="{{$author->id}}">{{$author->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control" id="category-multiselect" name="categories[]" multiple="multiple">
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Translator</label>
                        <select id="translator-multiselect" class="form-control" name="translator">
                            <option value="0">Select a translator</option>
                            @foreach($translators as $translator)
                                <option value="{{$translator->id}}">{{$translator->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>Country</label>
                        <input type="text" name="country" class="form-control">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Language</label>
                        <input type="text" name="language" class="form-control">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Edition</label>
                        <input type="text" name="edition" class="form-control">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Number of pages</label>
                        <input type="text" name="numberOfPages" class="form-control">
                    </div>
                </div>
            </div>

            <div class="row" style="padding: 10px; border: 1px solid black">
                <div class="col-5">
                    <label>Choose an Image</label>
                    <input class="form-control" name="image" type="file" accept="image/*" onchange="loadFile(event)">
                </div>
                <div class="col-2">
                    <img id="output"/>
                </div>
                <script>
                    var loadFile = function(event) {
                        var output = document.getElementById('output');
                        output.src = URL.createObjectURL(event.target.files[0]);
                        output.setAttribute('height', '240px');
                        output.setAttribute('width', '160px');
                        output.style.border = "5px solid green";
                        output.onload = function() {
                            URL.revokeObjectURL(output.src) // free memory
                        };
                    };
                </script>
                <div class="col-5">
                    <label>Choose Demo Reading Content</label>
                    <input class="form-control" name="demoContent" type="file">
                </div>
            </div>

            <button type="submit" class="btn btn-info btn-block mt-3">Submit</button>
        </form>
    </div>
@endsection

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('scripts')
    <script src="https://cdn.tiny.cloud/1/1gmr8v9a7arm4fsi5snndngfk5700il49gyod6xk0niqdtct/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#author-multiselect').select2();
            $('#category-multiselect').select2();
            $('#translator-multiselect').select2();
            $('#publisher-multiselect').select2();
        });
    </script>
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            toolbar_mode: 'floating',
        });
    </script>
@endpush