<x-app>
    <login-page>
        <form method="POST" class="w-full h-full flex flex-col justify-evenly" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label class="text-gray-600">Email Address</label>
				<div>
					<input
					    type="email"
                        name="email"
                        value="{{ old('email') }}" 
						class="bg-transparent border-b border-gray-600 w-full py-1 rounded-sm focus:outline-none @error('email') is-invalid @enderror"
						placeholder="Enter email"
						required
						autocomplete="email"
						autofocus
					/>

                    @error('email')
                        <span>
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
				</div>
            </div>
            <div class="mb-3">
                <label class="text-gray-600">Password</label>
                <div>
                    <input
                        type="password"
                        name="password"
                        class="bg-transparent border-b border-gray-600 w-full py-1 rounded-sm focus:outline-none @error('password') is-invalid @enderror"
                        placeholder="Enter password"
                        required
                        autocomplete="current-password"
                    />

                    @error('password')
                        <span>
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div>
                <button type="submit" class="bg-gray-800 w-full py-3 text-white rounded-md">
                    LOGIN
                </button>
            </div>
            <p class="w-full flex justify-between">
                Don't have an account
                <a href="{{ route('register') }}" class="text-gray-800 font-bold">Register</a>
            </p>
            <a href="{{ url('/') }}" class="w-full text-center text-gray-800 font-bold">Go back</a>
        </form>
    </login-page>
</x-app>