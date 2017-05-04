<nav class="navbar navbar-toggleable-xs bg-faded fixed-top">
    <div class="container">

        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </button>

        <a href="{{ url('/') }}" class="navbar-brand">
            {{ config('app.name', 'Typonaut') }}
        </a>

        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav text-right">

                {{--<li class="nav-item">--}}
                    {{--<a class="nav-link" href="{{ route('history') }}">History</a>--}}
                {{--</li>--}}

                @if (\Auth::guest())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="nav-link">Register</a>
                    </li>
                @else

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('lobby') }}">Lobby</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item"
                               href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </li>
                @endif
            </ul>
        </div>

    </div>
</nav>
