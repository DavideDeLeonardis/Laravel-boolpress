@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <form action="{{ route('admin.posts.update', $post->id) }}" method="post">
                @csrf
                @method('PATCH')

                <div>
                    <label for="title" class="form-label">title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">

                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label for="content" class="form-label">Img</label>
                    <input type="text" class="form-control" id="content" name="content" value="{{ $post->content }}">

                    @error('content')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit">Save</button>
            </form>
        </div>
    </div>
@endsection
