@extends('layouts.register')
@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col">
            <form action="{{ route('create') }}" method="post" enctype="multipart/form-data">
                @csrf
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                {{-- @if ($errors->any())
                    <div class="alert alert-warning">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif --}}
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
                    @error('title')
                        <div class="alert alert-warning mt-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="desc" class="form-label">Description</label>
                    <textarea class="form-control" name="desc" id="desc" cols="30" rows="10">{{ old('desc') }}</textarea>
                    @error('desc')
                        <div class="alert alert-warning mt-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" name="image" id="image" class="form-control">
                    @error('image')
                        <div class="alert alert-warning mt-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <input class="btn btn-success" type="submit" value="Create">
                </div>
            </form>
        </div>
        <div class="col">
            <div class="row">
                <div class="col">
                    <h2>Total-{{ $posts->total() }}</h2>
                </div>
                <div class="col ">
                   <form action="{{ route('index.show') }}" class="d-flex">
                    <input value="{{ request('search') }}" type="text" name="search" class="form-control" placeholder="Enter the title">
                    <button type="submit" class="btn btn-outline-danger ms-1">Search</button>
                   </form>
                </div>
            </div>
            @if (count($posts)!==0)
            @foreach ($posts as $post)
            <div class="shadow-sm p-2 mb-2">
                <h3>{{ $post->title }}</h3>
                <p>{{ Str::words($post->description,10, '...') }}</p>
                {{-- <img style="width:200px;height:200px;" src="{{ Storage::url('images/'.$post->image) }}" alt=""> --}}
                @if ($post->image == null)
                <img style="width:100px;height:q00px;" src="{{ asset('404.jpg') }}" alt="" >
                @else
                <img style="width:100px;height:100px;" src="{{ asset('storage/images/'.$post->image) }}" alt="" >
                @endif
                <div class="text-end mt-1">
                    <a href="{{ route('customer.edit',$post->id) }}" class="btn btn-success">Edit</a>
                    <a href="{{ route('customer.delete',$post->id) }}" class="btn btn-danger">Delete</a>
                </div>
            </div>
            @endforeach
            @else
            <div class="text-danger mt-5">there is no data</div>
            @endif
        </div>
        {{ $posts->appends(request()->query())->links() }}
    </div>
</div>

@endsection
