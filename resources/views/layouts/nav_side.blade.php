<nav class="menu" role="navigation">
    <div class="brand">{{ config('app.name') }}</div>
    <ul>
        {{--        <li><a href="{{ route('history') }}">History</a></li>--}}

        @if (\Auth::guest())

            <li><a href="{{ route('login') }}">Login</a></li>
            <li><a href="{{ route('register') }}">Register</a></li>

        @else

            <li><a href="{{ route('lobby') }}">Lobby</a></li>

            <nested-nav-item>
                <template slot="title">{{ Auth::user()->name }}</template>

                <li>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                </li>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </nested-nav-item>

        @endif
    </ul>
</nav>
