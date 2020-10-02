@extends('layouts.admin')

@section('content')
    <div class="jumbotron" style="text-align: center">
        <h1>Update A Book</h1>
    </div>

    <br>

    <div class="container">
        <h3 class="text-center"><b>Enter Details</b>
            <hr></h3>

        <form action="{{route('admin.book.update', $book[0]->slug)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" value="{{$book[0]->title}}" name="title" class="form-control">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Sub Title</label>
                        <input type="text" value="{{$book[0]->sub_title}}" name="subTitle" class="form-control">
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
                        <input type="text" value="{{$book[0]->price}}" name="price" class="form-control">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Discounted Price</label>
                        <input type="text" value="{{$book[0]->discount_price}}" name="discountedPrice" class="form-control">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Enter current stock</label>
                        <input type="text" name="stock" value="{{$book[0]->stock}}" class="form-control">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Publisher</label>
                        <select id="publisher-multiselect" class="form-control" name="publisher">
                            @foreach($publishers as $publisher)
                                @if($publisher->id != $book[0]->publisher_id)
                                    <option value="{{$publisher->id}}">{{$publisher->title}}</option>
                                @else
                                    <option value="{{$publisher->id}}" selected="selected">{{$publisher->title}}</option>
                                @endif
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
                                @if(in_array($author->id, $authorID))
                                    <option value="{{$author->id}}" selected="selected">{{$author->name}}</option>

                                @else
                                    <option value="{{$author->id}}">{{$author->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control" id="category-multiselect" name="categories[]" multiple="multiple">
                            @foreach($categories as $category)
                                @if(in_array($category->id, $categoriesID))
                                    <option value="{{$category->id}}" selected="selected">{{$category->title}}</option>
                                @else
                                    <option value="{{$category->id}}">{{$category->title}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Translator</label>
                        <select id="translator-multiselect" class="form-control" name="translator">
                            @if($book[0]->translator_id != 0)
                                <option value="{{$book[0]->translator_id}}">{{$book[0]->translator->name}}</option>
                                <option value="0">No translator</option>
                            @else
                                <option value="0">Select a translator</option>
                            @endif
                            @foreach($translators as $translator)
                                    @if($translator->id != $book[0]->translator_id)
                                        <option value="{{$translator->id}}">{{$translator->name}}</option>
                                    @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>Country</label>
                        <input type="text" value="{{$book[0]->country}}" name="country" class="form-control">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Language</label>
                        <input type="text" value="{{$book[0]->language}}" name="language" class="form-control">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Edition</label>
                        <input type="text" value="{{$book[0]->edition}}" name="edition" class="form-control">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Number of pages</label>
                        <input type="text" value="{{$book[0]->page_count}}" name="numberOfPages" class="form-control">
                    </div>
                </div>
            </div>

            <div class="row" style="padding: 10px; border: 1px solid black">
                <div class="col-5">
                    <label>Choose an Image</label>
                    <input class="form-control" value="{{$book[0]->image_path}}}}" name="image" type="file" accept="image/*" onchange="loadFile(event)">
                </div>
                <div class="col-2">
                    <img id="output" src="{{url('/storage/'.$book[0]->image_path)}}" height="240px" width="160px"/>
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
                    <input class="form-control" value="{{$book[0]->demo_path}}" name="demoContent" type="file">
                    @if($book[0]->demo_path != null)
                            <br>
                        <a class="btn btn-success" href="{{url('/storage/'.$book[0]->demo_path)}}" target="_blank">View current PDF</a>
                    @endif
                </div>
            </div>

            <button type="submit" class="btn btn-warning btn-block mt-3">Submit</button>
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
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.1.1/pdfobject.js"></script>--}}
{{--    <script>PDFObject.embed('{{url('/storage/'.$book[0]->demo_path)}}', "#example1");</script>--}}
    <script>
        $(document).ready(function() {
            $('#author-multiselect').select2({tags: true});
            $('#category-multiselect').select2({tags: true});
            $('#translator-multiselect').select2();
            $('#publisher-multiselect').select2();
        });
    </script>
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            toolbar_mode: 'floating',
            setup: function (editor) {
                editor.on('init', function (e) {
                    editor.setContent('<?php echo $book[0]->description; ?>');
                });
            }
        });
    </script>
@endpush