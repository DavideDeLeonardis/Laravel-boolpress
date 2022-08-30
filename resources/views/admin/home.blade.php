@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-4">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}<br>
                        @if (Auth::user()->roles()->get()->contains('1'))
                            <a style="text-align: center" href="{{ route('admin.posts.index') }}">All Posts</a><br>
                            <a style="text-align: center" href="{{ route('admin.posts.indexUser') }}">My Posts</a>
                        @else
                            <a style="text-align: center" href="{{ route('admin.posts.indexUser') }}">My Posts</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
