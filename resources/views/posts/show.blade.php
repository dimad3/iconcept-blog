@extends('layouts.app')

@section('title', $post->title)

@section('content')

    <div class="bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-3xl font-bold text-gray-800">{{ $post->title }}</h1>

        <p class="text-gray-600 mt-2">By <span class="font-semibold">{{ $post->user->name }}</span>
            | Created on <span class="font-semibold">{{ $post->created_at->format('F j, Y') }}</span>
            | Last updated: <span class="font-semibold">{{ $post->updated_at->format('F j, Y') }}</span>
        </p>
        <p class="text-gray-600 mt-2">
            Category:
            @forelse ($post->categories as $category)
                @if (!$loop->first)
                    |
                @endif
                <a href="{{ route('categories.posts.index', $category) }}"
                    class="text-blue-500 hover:underline">{{ $category->name }}</a>
            @empty
                <span class="text-gray-400">No categories assigned</span>
            @endforelse
        </p>

        <!-- Button to return to posts.index -->
        <div class="mt-4">
            <a href="{{ route('posts.index') }}"
                class="bg-gray-300 px-4 py-2 text-gray-800 rounded hover:bg-gray-400">Return
                to Posts List</a>
        </div>

        <div class="mt-4 border-t pt-4 text-gray-700">
            <p class="text-lg">{{ $post->body }}</p>
            <div class="mt-2 text-gray-600 text-sm">
                {!! nl2br(e($post->content)) !!}
            </div>
        </div>

        <div class="mt-6">
            @can('manage-post', $post)
                <a href="{{ route('posts.edit', $post) }}" class="bg-yellow-500 px-4 py-2 text-white rounded">Edit</a>
                <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="bg-red-500 px-4 py-2 text-white rounded"
                        onclick="return confirm('Delete this post?')">Delete</button>
                </form>
            @endcan
        </div>
    </div>

    <!-- Comments Section -->
    <div class="mt-8 bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold mb-4">Comments ({{ $post->comments?->count() }})</h2>

        @forelse ($post->comments as $comment)
            <div class="border-t py-4">
                <p class="text-gray-800"><strong>{{ $comment->user->name }}</strong> <span
                        class="text-sm text-gray-600">({{ $comment->created_at->diffForHumans() }})</span></p>
                <p class="text-gray-700 mt-2">{{ $comment->content }}</p>

                @can('manage-comment', $comment)
                    <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-500 text-sm"
                            onclick="return confirm('Delete this comment?')">Delete comment</button>
                    </form>
                @endcan
            </div>

        @empty
            <p>Be the first to comment on this post!</p>
        @endforelse

        <!-- Add Comment Form -->
        @auth
            <div class="mt-6">
                <h3 class="text-lg font-semibold">Leave a Comment</h3>
                <form action="{{ route('comments.store') }}" method="POST" class="mt-4">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <textarea name="content" rows="3" class="w-full border rounded p-2" placeholder="Write your comment..." required>{{ old('content') }}</textarea>
                    <button type="submit" class="mt-2 bg-blue-500 px-4 py-2 text-white rounded">Post Comment</button>
                </form>
            </div>
        @else
            <p class="mt-4 text-gray-600">Please <a href="{{ route('login') }}" class="text-blue-500 hover:underline">log
                    in</a> to leave a comment.</p>
        @endauth
    </div>

@endsection
