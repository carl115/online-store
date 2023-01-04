<x-app>
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