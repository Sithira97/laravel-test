@extends('layouts.master')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h3>Post No. {{ $post->id }}</h3>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <a href="{{ route('posts.index') }}" class="btn btn-primary mx-1">Back</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="posts" class="table table-striped table-bordered" style="table-layout: fixed;">
                    <tbody>
                            <tr>
                                <th scope="row">Image</th>
                                <td><img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" width="300"></td>
                            </tr>
                            <tr>
                                <th scope="row">Title</th>
                                <td>{{ $post->title }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Category</th>
                                <td>{{ $post->category->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Description</th>
                                <td>{{ $post->content }}</td>

                            </tr>
                            <tr>
                                <th scope="row">Published At</th>
                                <td>{{ $post->published_date }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Last Updated At</th>
                                <td>{{ $post->updated_at }}</td>
                            </tr>
                            <tr>
                                <th scope="row">View Count</th>
                                <td>{{ $post->views }}</td>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection