<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\SavePostRequest;
use App\Models\Category;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Post::with('categories', 'user');

        // Check if search query exists
        if (request('search')) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . request('search') . '%')
                    ->orWhere('body', 'like', '%' . request('search') . '%');
            });
        }

        $posts = $query->latest()->paginate(10)->withQueryString();
        $heading = request('search') ? "Search results for: " . request('search') : "All Posts";

        return view('posts.index', compact('posts', 'heading'));
    }

    public function myPosts()
    {
        $query = Post::forUser(auth()->user())->with('categories', 'user');

        if (request('search')) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . request('search') . '%')
                    ->orWhere('body', 'like', '%' . request('search') . '%');
            });
        }

        $posts = $query->latest()->paginate(10)->withQueryString();
        $heading = request('search')
            ? "Search results for \"" . request('search') . "\" in My Posts"
            : "My Posts";

        return view('posts.index', compact('posts', 'heading'));
    }

    public function categoryPosts(Category $category)
    {
        $query = $category->posts()->with('categories', 'user');

        if (request('search')) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . request('search') . '%')
                    ->orWhere('body', 'like', '%' . request('search') . '%');
            });
        }

        $posts = $query->latest()->paginate(10)->withQueryString();
        $heading = request('search')
            ? "Search results for \"" . request('search') . "\" in {$category->name}"
            : "Posts in {$category->name}";

        return view('posts.index', compact('posts', 'heading'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SavePostRequest $request)
    {
        $post = auth()->user()->posts()->create($request->only(['title', 'body', 'content']));

        // Attach selected categories
        $post->categories()->attach($request->category_ids);

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $comments = $post->comments()->with('user')->latest()->get();
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SavePostRequest $request, Post $post)
    {
        $post->update($request->only(['title', 'body', 'content']));

        // Sync categories
        $post->categories()->sync($request->category_ids);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
