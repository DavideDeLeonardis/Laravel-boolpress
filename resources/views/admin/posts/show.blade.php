@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            @if (session('status'))
                <div class="alert alert-danger">
                    {{ session('status') }}
                </div>
            @endif
        </div>

        <div class="row">
            <div class="col">
                <h2 class="d-inline-block">Title:</h2>
                <span>{{ $post->title }}</span><br>

                <h4 class="d-inline-block">Author:</h4>
                <span>{{ $post->user()->first()->name }}</span><br>

                <h4 class="d-inline-block">Category:</h4>
                <span>{{ $post->category()->first()->name }}</span><br>

                <h4 class="d-inline-block">Tags:</h4>
                @foreach ($post->tags as $tag)
                    <span>{{ $tag->name }}</span>
                @endforeach
            </div>
        </div>

        <div class="row">
            <div class="col">
                <h4 class="d-inline-block">Content:</h4> {{ $post->content }}
            </div>
        </div>

        <div class="row">
            <div class="col">
                <img class="img-fluid" src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
            </div>
        </div>
    </div>
@endsection
