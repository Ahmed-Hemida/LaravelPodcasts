<nav class="navbar navbar-expand-md navbar-dark bg-white shadow-sm text-dark">
    <div class="container text-dark">
        <a class="navbar-brand text-dark" href="{{ url('/') }}">
            <div class="d-inline">
                <img src="https://cdn.podu.me/img/favicon/favicon.ico" class="rounded-circle w-25 ">
            </div>
            {{ config('app.name', 'Laravel') }}
        </a>
       
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active text-dark" aria-current="page" href="{{route('podcast.form.view')}}">Create</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active text-dark" aria-current="page" href="{{route('home')}}">index</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active text-dark" aria-current="page" href="/podcast/view">podcasts view</a>
        </li>
      </ul>

        <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse  text-dark" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto ">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto text-dark">
                <!-- Authentication Links -->
                @guest
                @if (Route::has('login'))
                <li class="nav-item ">
                    <a class=" text-dark" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @endif

                @if (Route::has('register'))
                <li class="nav-item text-dark ">
                    <a class=" text-dark" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
                @endif
                @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown text-dark" class=" dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end  text-dark" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item text-dark" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>