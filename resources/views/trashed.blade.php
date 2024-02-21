@extends('layouts.master')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h3>Trashed Posts</h3>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <a href="{{ route('posts.index') }}" class="btn btn-primary mx-1">Back</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="posts" class="table table-striped table-bordered" style="table-layout: fixed;">
                    <thead>
                        <tr class="text-center">
                            <th scope="col" style="width: 4%">#</th>
                            <th scope="col" style="width: 8%">Image</th>
                            <th scope="col" style="width: 14%">Title</th>
                            <th scope="col" style="width: 35%">Description</th>
                            <th scope="col" style="width: 10%">Category</th>
                            <th scope="col" style="width: 10%">Published Date</th>
                            <th scope="col" style="width: 19%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <th scope="row">{{ $post->id }}</th>
                                <td><img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" width="80"></td>
                                <td class="text-truncate">{{ $post->title }}</td>
                                <td class="text-truncate">{{ $post->content }}</td>
                                <td>{{ $post->category->name }}</td>
                                <td>{{ $post->published_date }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a class="btn btn-success mx-1"
                                            href="{{ route('posts.restore', $post->id) }}">Restore</a>

                                        <form method="POST" action="{{ route('posts.force_delete', $post->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger mx-1">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$posts->links() }}
            </div>
        </div>
    </div>
@endsection
