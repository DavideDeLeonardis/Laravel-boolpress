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
                        <input type="submit" class="btn btn-light" value="Logout">
                    </form>
                    <span class="mx-3" style="color: white">{{ Auth::user()->name }}</span>
                    <span class="mx-3" style="color: white">Role: {{ Auth::user()->roles()->first()->name }}</span>
                    <span class="mx-3" style="color: white">Role ID: {{ Auth::user()->roles()->first()->pivot->role_id }}</span>
                @endguest
            </div>
        </div>
    </div>
</nav>
