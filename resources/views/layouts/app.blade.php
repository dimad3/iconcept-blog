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

            <!-- Search Form and Navigation Links -->
            <div class="flex items-center space-x-4">
                @unless (request()->is('/'))
                    <!-- Search Form -->
                    <form action="{{ request()->url() }}" method="GET" class="flex">
                        <input type="text" name="search" placeholder="Search posts..." value="{{ request('search') }}"
                            class="rounded-l px-4 py-2 w-64 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-r transition duration-150 ease-in-out">
                            Search
                        </button>
                    </form>
                @endunless

                <a href="{{ route('posts.create') }}"
                    class="bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded transition duration-150 ease-in-out">Create
                    Post</a>

                @auth
                    <span class="text-gray-300">Welcome, <a href="{{ route('profile.edit') }}"
                            class="text-white hover:underline">{{ auth()->user()->name }}!</a></span>
                    <a href="{{ route('my_posts') }}"
                        class="bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded transition duration-150 ease-in-out">My
                        Posts</a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded transition duration-150 ease-in-out">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="bg-green-500 hover:bg-green-600 px-4 py-2 rounded transition duration-150 ease-in-out">Login</a>
                    <a href="{{ route('register') }}"
                        class="bg-yellow-500 hover:bg-yellow-600 px-4 py-2 rounded transition duration-150 ease-in-out">Register</a>
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
        @if (session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif
        @yield('content')
    </div>
</body>

</html>
