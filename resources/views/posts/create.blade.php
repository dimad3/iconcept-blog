@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
    <h2 class="text-2xl font-semibold mb-4">Create New Post</h2>
    @include('posts._form', ['post' => new App\Models\Post()])
@endsection

