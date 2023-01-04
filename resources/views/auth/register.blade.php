{{--
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
--}}

<x-app>
    {{--
    <nav-bar>
        @guest
            @if (Route::has('login'))
                <a href="{{ route('login') }}">Login</a>
            @endif
            @if (Route::has('register'))
                <a href="{{ route('register') }}">Register</a>
            @endif
            @else
            <a href="#">
                {{ Auth::user()->name }}
            </a>
            <div>
                <a
                    href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                </form>
            </div>
        @endguest
    </nav-bar>
    --}}
    <login-page>
        <form method="POST" class="w-full h-full flex flex-col justify-evenly" action="{{ route('register') }}">
            @csrf
            <div class="mb-4">
                <label class="text-gray-600">Name</label>
                <div>
                    <input 
                        type="text" 
                        class="bg-transparent border-b border-gray-600 w-full py-1 rounded-sm focus:outline-none @error('name') is-invalid @enderror" 
                        name="name" 
                        value="{{ old('name') }}" 
                        placeholder="Enter name"
                        required 
                        autocomplete="name" 
                        autofocus
                    />

                    @error('name')
                        <span>
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="mb-4">
                <label class="text-gray-600">Email Address</label>
                <div>
                    <input 
                        type="email" 
                        class="bg-transparent border-b border-gray-600 w-full py-1 rounded-sm focus:outline-none @error('email') is-invalid @enderror" 
                        name="email" 
                        value="{{ old('email') }}" 
                        placeholder="example@example.com"
                        required 
                        autocomplete="email"
                    />

                    @error('email')
                        <span>
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="mb-4">
                <label class="text-gray-600">Password</label>
                <div>
                    <input 
                        type="password" 
                        class="bg-transparent border-b border-gray-600 w-full py-1 rounded-sm focus:outline-none @error('password') is-invalid @enderror" 
                        name="password" 
                        placeholder="Enter password"
                        required 
                        autocomplete="new-password"
                    />

                    @error('password')
                        <span>
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="mb-4">
                <label class="text-gray-600">Confirm Password</label>
                <div>
                    <input 
                        type="password" 
                        class="bg-transparent border-b border-gray-600 w-full py-1 rounded-sm focus:outline-none" 
                        name="password_confirmation"
                        placeholder="Enter confirm password" 
                        required 
                        autocomplete="new-password"
                    />
                </div>
            </div>
            <div>
                <button type="submit" class="bg-gray-800 w-full py-3 my-3 text-white rounded-md">
                    REGISTER
                </button>
            </div>
            <p class="w-full my-3 flex justify-between">
                Do you already have an account?
                <a href="{{ route('login') }}" class="text-gray-800 font-bold">Login</a>
            </p>
            <a href="{{ url('/') }}" class="w-full mt-3 text-center text-gray-800 font-bold">Go back</a>
        </form>
    </login-page>
</x-app>