@extends('layouts.register')
@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-6 offset-3">
            <a href="{{ route('create') }}" class="btn btn-danger mb-3">back to list</a>
            <form action="{{ route('customer.update',$post->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-warning">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title',$post->title) }}">
                </div>
                <div class="mb-3">
                    <label for="desc" class="form-label">Description</label>
                    <textarea class="form-control" name="desc" id="desc" cols="30" rows="10">{{ old('desc',$post->description) }}</textarea>
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
                    <input class="btn btn-success" type="submit" value="Update">
                </div>
            </form>
        </div>

    </div>
</div>

@endsection
