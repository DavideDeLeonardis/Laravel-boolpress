<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Boolpress') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('script')
</head>

<body>
    <nav class="navbar navbar-expand-lg @guest navbar-light light-dark @endguest @auth navbar-dark bg-dark @endauth">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('admin.home') }}">{{ config('app.name', 'Laravel') }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav align-items-center">
                    @guest
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        @if (Route::has('register'))
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                    @else
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            @method('POST')
                            <input type="submit" class="btn btn-light" value="Logout">
                        </form>
                        <span class="mx-3 text-white">{{ Auth::user()->name }}</span>
                        <span class="mx-3 text-white">Role: {{ Auth::user()->roles()->first()->name }}</span>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <main class="py-4">
        <div class="container-fluid">
            <div class="row">
                <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                    <div class="position-sticky pt-3">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.home') }}">
                                    <i class="bi bi-house"></i>
                                    Home
                                </a>
                            </li>
                            @if (Auth::user()->roles()->get()->contains('1'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.posts.index') }}">
                                        <i class="bi bi-files"></i>
                                        All Posts
                                    </a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.posts.indexUser') }}">
                                    <i class="bi bi-files"></i>
                                    My Posts
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.categories.index') }}">
                                    <i class="bi bi-files"></i>
                                    All Categories
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.posts.create') }}">
                                    <i class="bi bi-files"></i>
                                    Create Post
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>

                <div class="col">
                    @yield('content')
                </div>
            </div>
        </div>
    </main>
</body>

</html>
