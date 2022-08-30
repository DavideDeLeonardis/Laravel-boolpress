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
                <h1>{{ $postH1 ?? '' }}</h1>
            </div>
        </div>

        <div class="row">
            <table class="table table-striped w-100">
                <thead>
                    <tr>
                        <th scope="col">Editor Name</th>
                        <th scope="col">Title</th>
                        <th scope="col">Category</th>
                        <th scope="col">Tags</th>
                        <th scope="col">Created At</th>
                        <th colspan="3" scope="col">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td>{{ $post->user()->first()->name }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->category->name }}</td>
                            <td>
                                @foreach ($post->tags()->get() as $tag)
                                    {{ $tag->name }}
                                @endforeach
                            </td>
                            <td>
                                {{ Carbon\Carbon::parse($post->created_at)->day }}
                                {{ Carbon\Carbon::parse($post->created_at)->englishMonth }}
                                {{ Carbon\Carbon::parse($post->created_at)->year }},
                                {{ Carbon\Carbon::parse($post->created_at)->format('H:i:s') }}

                            </td>
                            <td>
                                <a class="btn btn-primary" href="{{ route('admin.posts.show', $post->slug) }}">View</a>
                            </td>
                            <td>
                                <a class="btn btn-info" href="{{ route('admin.posts.edit', $post->slug) }}">Modify</a>
                            </td>
                            <td>
                                <form action="{{ route('admin.posts.destroy', $post) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input class="btn btn-danger" type="submit" value="Delete">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

                <tfoot>
                    <tr>
                        <td colspan="8">{{ $posts->links() }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection

