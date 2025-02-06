<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    <nav class="bg-gray-900 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="text-lg font-bold">Home</a>

            <!-- Navigation Links -->
            <div class="flex items-center space-x-4">
                <a href="{{ route('posts.create') }}" class="bg-blue-500 px-4 py-2 rounded text-white">Create Post</a>

                @auth
                    <span class="text-gray-300">Welcome, <a href="{{ route('profile.edit') }}"
                            class="text-white hover:underline">{{ auth()->user()->name }}!</a></span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-red-500 px-4 py-2 rounded text-white">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="bg-green-500 px-4 py-2 rounded text-white">Login</a>
                    <a href="{{ route('register') }}" class="bg-yellow-500 px-4 py-2 rounded text-white">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container mx-auto mt-6 p-6 bg-white shadow-lg rounded-lg">
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @yield('content')
    </div>
</body>

</html>
