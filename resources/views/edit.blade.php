@extends('layouts.master')

@section('content')
    <div class="container mt-4">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
        @endif
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        Edit Post
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <a href="{{ route('posts.index') }}" class="btn btn-primary mx-1">Back</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <img src="{{ asset('storage/' . $post->image) }}" width="50%" alt="">
                <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group mt-2">
                        <label for="" class="form-label">Title</label>
                        <input type="text" name="title" id="title" placeholder="Title" class="form-control"
                            value="{{ $post->title }}">
                    </div>
                    <div class="form-group mt-2">
                        <label for="" class="form-label">Category</label>
                        <select type="text" name="category_id" id="category_id" class="form-control">
                            <option value="">Select...</option>
                            @foreach ($categories as $category)
                                <option {{ $category->id == $post->category_id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mt-2">
                        <label for="" class="form-label">Description</label>
                        <textarea type="text" name="content" id="content" placeholder="Title" class="form-control">{{ $post->content }}</textarea>
                    </div>
                    <div class="form-group mt-2">
                        <label for="" class="form-label">Image</label>
                        <input type="file" name="image" id="image" placeholder="Upload Image" class="form-control">
                    </div>
                    <div class="d-grid gap-2 mt-2">
                        <button type="submit" class="btn btn-success my-3">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
