@extends('layouts.app')

@section('title', 'Welcome!')

@section('content')
    <!-- Hero Section -->
    <section class="text-center py-20 bg-gradient-to-r from-blue-500 to-indigo-600 text-white">
        <div class="container mx-auto">
            <h1 class="text-5xl font-extrabold">Welcome to iConcept Blog</h1>
            <p class="mt-4 text-lg text-gray-200">A place to share your thoughts, ideas, and experiences.</p>
            <div class="mt-6">
                <a href="{{ route('posts.index') }}"
                    class="bg-white text-blue-600 px-6 py-3 rounded-lg shadow-md font-semibold hover:bg-gray-200 transition">
                    Browse Posts
                </a>
                @guest
                    <a href="{{ route('register') }}"
                        class="ml-4 bg-yellow-500 px-6 py-3 rounded-lg text-white shadow-md font-semibold hover:bg-yellow-600 transition">
                        Get Started
                    </a>
                @endguest
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="container mx-auto my-16 px-6 grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="p-6 bg-white rounded-lg shadow-lg text-center">
            <h3 class="text-xl font-semibold text-gray-800">Write & Share</h3>
            <p class="mt-2 text-gray-600">Create and share your posts with the world.</p>
        </div>
        <div class="p-6 bg-white rounded-lg shadow-lg text-center">
            <h3 class="text-xl font-semibold text-gray-800">Engage with Comments</h3>
            <p class="mt-2 text-gray-600">Comment and discuss on interesting topics.</p>
        </div>
        <div class="p-6 bg-white rounded-lg shadow-lg text-center">
            <h3 class="text-xl font-semibold text-gray-800">Categorized Content</h3>
            <p class="mt-2 text-gray-600">Find posts based on your favorite categories.</p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white text-center py-6">
        <p>&copy; {{ date('Y') }} iConcept Blog. All rights reserved.</p>
    </footer>
@endsection
