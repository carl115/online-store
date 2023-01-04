<x-app>
    <nav-bar user-data="{{ Auth::user() }}">
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/home') }}" class="hover:text-white">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="hover:text-white">Log in</a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="hover:text-white">Register</a>
            @endif
            @endauth
        @endif
    </nav-bar>
    <cart user-data="{{ Auth::user() }}" ></cart>
</x-app>