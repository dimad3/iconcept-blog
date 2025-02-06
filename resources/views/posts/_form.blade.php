<form action="{{ $post->exists ? route('posts.update', $post) : route('posts.store') }}" method="POST" class="space-y-4">
    @csrf
    @if ($post->exists)
        @method('PUT')
    @endif

    <div>
        <label for="title" class="block text-gray-700">Title</label>
        <input id="title" type="text" name="title" class="w-full border rounded p-2"
            value="{{ old('title', $post->title) }}" required>
    </div>

    <div>
        <label for="body" class="block text-gray-700">Body</label>
        <textarea id="body" name="body" class="w-full border rounded p-2" required>{{ old('body', $post->body) }}</textarea>
    </div>

    <div>
        <label for="content" class="block text-gray-700">Content</label>
        <textarea id="content" name="content" class="w-full border rounded p-2" required>{{ old('content', $post->content) }}</textarea>
    </div>

    <div>
        <label for="category_id" class="block text-gray-700">Category</label>
        <select id="category_id" name="category_id" class="w-full border rounded p-2" required>
            <option value=""></option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="bg-blue-500 px-4 py-2 text-white rounded">
        {{ $post->exists ? 'Update' : 'Create' }}
    </button>
</form>
