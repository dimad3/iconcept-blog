@extends('layouts.app')

@section('title', 'All Posts')

@section('content')
    <h2 class="text-2xl font-semibold mb-4">{{ $heading }}</h2>

    <table class="w-full bg-white border rounded shadow-md">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2 text-left">#</th>
                <th class="px-4 py-2 text-left">Title</th>
                <th class="px-4 py-2 text-left">Category</th>
                <th class="px-4 py-2 text-left">Author</th>
                <th class="px-4 py-2 text-left">Created</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $loop->iteration }}</td>
                    <td class="px-4 py-2"><a href="{{ route('posts.show', $post) }}"
                            class="hover:underline">{{ $post->title }}</a>
                    </td>
                    <td class="px-4 py-2">
                        @forelse ($post->categories as $category)
                            @if (!$loop->first)
                                |
                            @endif
                            <a href="{{ route('categories.posts.index', $category) }}" class="hover:underline">{{ $category->name }}</a>
                        @empty
                            <span class="text-gray-400">No categories assigned</span>
                        @endforelse
                    </td>
                    <td class="px-4 py-2">{{ $post->user->name }}</td>
                    <td class="px-4 py-2">{{ $post->created_at }}</td>
                    <td class="px-4 py-2 text-center">
                        <a href="{{ route('posts.show', $post) }}" class="text-blue-500">View</a>
                        @auth
                            |
                            <a href="{{ route('posts.edit', $post) }}" class="text-yellow-500">Edit</a> |
                            <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-500"
                                    onclick="return confirm('Delete this post?')">Delete</button>
                            </form>
                        @endauth
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">{{ $posts->links() }}</div>
@endsection
