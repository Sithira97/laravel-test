@extends('layout.master')

@section('content')
    <main role="main" class="container mt-5">
        <div class="row">
            {{-- @foreach ($users as $user)
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h4>Name : {{ $user->name }}</h4>
                            <p>E-mail : {{ $user->email }}</p>
                            <p>Address : {{ $user->address->address }}</p>
                        </div>
                    </div>
                </div>
            @endforeach --}}

            {{-- @foreach ($addresses as $address)
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h4>Name : {{ $address->user->name }}</h4>
                            <p>E-mail :{{ $address->user->email }}</p>
                            <p>Address : {{ $address->address }}</p>
                        </div>
                    </div>
                </div>
            @endforeach --}}

            {{-- @foreach ($categories as $category)
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h4>Title : {{ $category->title }}</h4>
                            <p>Category : {{ $category->category->name }}</p>
                            <p>Content : {{ $category->content }}</p>
                        </div>
                    </div>
                </div>
            @endforeach --}}

            {{-- @foreach ($posts as $post)
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h4>Title : {{ $post->title }}</h4>
                            <p>Content : {{ $post->content }}</p>
                            <ul>
                            @foreach ($post->tags as $tag)
                            <li>{{ $tag->name }}</li>
                            @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach --}}
            <div class="card">
                <div class="card-body">
                    @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">{{$error}}</div>
                    @endforeach
                        
                    @endif
                    {{-- <img src="{{asset('/storage/images/new_image.jpg')}}" alt=""> --}}
                    <form action="{{route('imageHandle')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="fileUpload" class="mb-2">Upload:</label>
                            <input type="file" id="fileUpload" class="form-control" name="uploadFile"/>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block mt-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <a href="{{route('download')}}" class="btn btn-primary mt-3">Download Image</a>
    </main>
@endsection
