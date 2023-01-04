<x-app>
    @if (Auth::user())
        <nav-bar user-data="{{ Auth::user() }}">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/home') }}" class="mr-3 hover:text-white">Dashboard</a>
                    <div>
                        <button 
                            class="mx-3 hover:text-white"      
                            onmouseover="document.getElementById('userOptions').classList.remove('hidden')"
                            onmouseout="document.getElementById('userOptions').classList.add('hidden')"
                        >
                            {{ Auth::user()->name }}
                        </button>
                        <div 
                            id="userOptions" 
                            class="bg-slate-900 p-5 hidden flex flex-col absolute" 
                            onmouseover="document.getElementById('userOptions').classList.remove('hidden')" 
                            onmouseout="document.getElementById('userOptions').classList.add('hidden')"
                        >
				        <ul>
					        <li class="my-4">
						        <a href="{{route('logout')}}" class="hover:text-white">Logout</a>
					        </li>
				        </ul>
			            </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="mr-3 hover:text-white">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="mr-3 hover:text-white">Register</a>
                @endif
                @endauth
            @endif
        </nav-bar>
    @else
        <nav-bar>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard/products') }}" class="mr-3 hover:text-white">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="mr-3 hover:text-white">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="mr-3 hover:text-white">Register</a>
                @endif
                @endauth
            @endif
        </nav-bar>
    @endif
    <products-category data="{{$category}}" />
</x-app>