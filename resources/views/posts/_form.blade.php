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
        <label for="category_id" class="block text-gray-700">Categories</label>
        <select id="category_id" name="category_ids[]" multiple class="w-full border rounded p-2" required>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    {{ in_array($category->id, old('category_ids', $post->categories->pluck('id')->toArray())) ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        <p class="text-sm text-gray-500">Hold down Ctrl (Windows) or Command (Mac) to select multiple categories.</p>
    </div>

    <button type="submit" class="bg-blue-500 px-4 py-2 text-white rounded">
        {{ $post->exists ? 'Update' : 'Create' }}
    </button>
</form>
