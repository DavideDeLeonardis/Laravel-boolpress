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
                <h1>Posts</h1>
            </div>
        </div>

        <div class="row">
            <table class="table table-striped w-100">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Title</th>
                        <th scope="col">Category</th>
                        <th scope="col">Tags</th>
                        <th scope="col">Created At</th>
                        <th colspan="3" scope="col">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @if (Auth::user()->roles()->get()->contains('1'))
                        @foreach ($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->category_id }}</td>
                                <td>
                                    @foreach ($post->tags()->get() as $tag)
                                        {{ $tag->name }}
                                    @endforeach
                                </td>
                                <td>{{ $post->created_at }}</td>

                                {{-- button view --}}
                                <td>
                                    <a class="btn btn-primary" href="{{ route('admin.posts.show', $post->slug) }}">View</a>
                                </td>

                                {{-- button modify --}}
                                @if (Auth::user()->id === $post->user_id)
                                    <td>
                                        <a class="btn btn-info" href="{{ route('admin.posts.edit', $post->slug) }}">Modify</a>
                                    </td>
                                @endif

                                {{-- button delete --}}
                                @if (Auth::user()->id === $post->user_id)
                                    <td>
                                        <form action="{{ route('admin.posts.destroy', $post) }}" method="post">
                                            @csrf
                                            @method('DELETE')

                                            <input class="btn btn-danger" type="submit" value="Delete">
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        @foreach (Auth::user()->posts()->get() as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->category_id }}</td>
                                <td>
                                    @foreach ($post->tags()->get() as $tag)
                                        {{ $tag->name }}
                                    @endforeach
                                </td>
                                <td>{{ $post->created_at }}</td>

                                {{-- button view --}}
                                <td>
                                    <a class="btn btn-primary" href="{{ route('admin.posts.show', $post->slug) }}">View</a>
                                </td>

                                {{-- button modify --}}
                                @if (Auth::user()->id === $post->user_id)
                                    <td>
                                        <a class="btn btn-info" href="{{ route('admin.posts.edit', $post->slug) }}">Modify</a>
                                    </td>
                                @endif

                                {{-- button delete --}}
                                @if (Auth::user()->id === $post->user_id)
                                    <td>
                                        <form action="{{ route('admin.posts.destroy', $post) }}" method="post">
                                            @csrf
                                            @method('DELETE')

                                            <input class="btn btn-danger" type="submit" value="Delete">
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    @endif
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

