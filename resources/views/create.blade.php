@extends('layouts.master')

@section('content')
    <div class="container mt-4">
        @if ($errors-> any())
             @foreach ($errors->all() as $error)
                 <div class="alert alert-danger">{{$error}}</div>
             @endforeach   
        @endif
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h3>Create Post</h3>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <a href="{{ route('posts.index') }}" class="btn btn-primary mx-1">Back</a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mt-2">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" id="title" placeholder="Title" class="form-control">
                    </div>
                    <div class="form-group mt-2">
                        <label for="category_id" class="form-label">Category</label>
                        <select type="text" name="category_id" id="category_id" class="form-control">
                            <option value="">Select...</option>
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mt-2">
                        <label for="content" class="form-label">Description</label>
                        <textarea type="text" name="content" id="content" placeholder="Description" class="form-control"></textarea>
                    </div>
                    <div class="form-group mt-2">
                        <label for="image" class="form-label">Image</label>
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
