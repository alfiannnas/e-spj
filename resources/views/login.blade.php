<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Login - {{ config('app.name', 'Aplikasi e-SPJ') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                /*! tailwindcss v4.0.7 | MIT License | https://tailwindcss.com */
            </style>
        @endif
    </head>
    <body class="bg-white text-gray-900 font-sans antialiased">
        <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
            <div class="w-full max-w-md">
                <!-- Logo / Header -->
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-900">Aplikasi e-SPJ</h2>
                    <p class="mt-2 text-gray-600">Sign in to your account</p>
                </div>

                <!-- Login Form -->
                <form class="bg-white shadow-md rounded-lg px-8 pt-6 pb-8 mb-4" method="POST" action="">
                    @csrf

                    <!-- Email Input -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-medium mb-2" for="email">
                            Email Address
                        </label>
                        <input
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror"
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Enter your email"
                            required
                            autofocus
                        />
                        @error('email')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Input -->
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-medium mb-2" for="password">
                            Password
                        </label>
                        <input
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @enderror"
                            id="password"
                            type="password"
                            name="password"
                            placeholder="Enter your password"
                            required
                        />
                        @error('password')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between mb-6">
                        <label class="flex items-center text-gray-700 text-sm">
                            <input
                                class="w-4 h-4 rounded border-gray-300 text-blue-500 focus:ring-blue-500"
                                type="checkbox"
                                name="remember"
                                id="remember"
                                {{ old('remember') ? 'checked' : '' }}
                            />
                            <span class="ml-2">Remember me</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a class="text-sm text-blue-600 hover:text-blue-700" href="{{ route('password.request') }}">
                                Forgot password?
                            </a>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <button
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200"
                        type="submit"
                    >
                        Sign In
                    </button>

                    <!-- Sign Up Link -->
                    @if (Route::has('register'))
                        <p class="text-center text-gray-600 text-sm mt-4">
                            Don't have an account?
                            <a class="text-blue-600 hover:text-blue-700 font-medium" href="{{ route('register') }}">
                                Sign up
                            </a>
                        </p>
                    @endif
                </form>

                <!-- Additional Links -->
                @if (Route::has('login'))
                    <div class="text-center">
                        <a class="text-gray-600 hover:text-gray-900 text-sm" href="{{ url('/') }}">
                            Back to Home
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </body>
</html>
