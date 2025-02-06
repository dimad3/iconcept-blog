@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
    <h2 class="text-2xl font-semibold mb-4">Edit Post</h2>
    @include('posts._form', ['post' => $post])
@endsection
