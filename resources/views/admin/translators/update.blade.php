@extends('layouts.admin')

@section('content')
    <div class="jumbotron">
        <h1>Translator Update</h1>
        <br>
    </div>

    <br>
    <div class="container">
        <h3 class="text-center"><b>Update</b></h3>
        <form method="POST" action="{{route('admin.translators.update', $translators[0]->slug)}}">
            @csrf
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name" value="{{$translators[0]->name}}">
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea id="description" type="text" class="form-control" name="description"></textarea>
            </div>
            <div class="form-group">
                <label>Slug</label>
                <input type="text" class="form-control" name="slug" value="{{$translators[0]->slug}}">
            </div>
            <button type="submit" class="btn btn-warning btn-block">Update</button>
        </form>
    </div>


@endsection

@push('scripts')
    <script src="https://cdn.tiny.cloud/1/1gmr8v9a7arm4fsi5snndngfk5700il49gyod6xk0niqdtct/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            toolbar_mode: 'floating',
            setup: function (editor) {
                editor.on('init', function (e) {
                    editor.setContent('<?php echo $translators[0]->description; ?>');
                });
            }
        });
    </script>
@endpush