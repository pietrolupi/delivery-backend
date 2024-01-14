<header>
    <nav class="px-2 navbar-expand-lg h-100 ">
        <div class="d-flex justify-content-between align-items-center w-100 h-100">
            <a class="navbar-brand fs-4" href="{{ route('home')}}">Deliveboo</a>
            <div class="d-flex align-items-center h-100">
                <ul class="d-flex align-items-center m-0 gap-3 h-100 list-unstyled">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('login') }}">LOGIN</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('register') }}">REGISTER</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('admin.home')}}">
                                        Your account
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ url('profile') }}">
                                        {{__('Profile')}}
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item"                                            href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                </li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
{{--     <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav me-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{url('/') }}">HOME</a>
            </li>
        </ul>
        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">LOGIN</a>
            </li>
            @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">REGISTER</a>
            </li>
            @endif
            @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ url('dashboard') }}">{{__('Dashboard')}}</a>
                    <a class="dropdown-item" href="{{ url('profile') }}">{{__('Profile')}}</a>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
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
--}}
</header>
