<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Edit Article</h2>
    </x-slot>

    <div class="max-w-3xl mx-auto mt-4 bg-white p-6 rounded shadow">
        <form method="POST" action="{{ route('manage.articles.update', $article) }}" enctype="multipart/form-data" class="space-y-4">
            @csrf @method('PUT')

            <div>
                <label class="block mb-1 font-medium">Title</label>
                <input name="title" class="w-full border rounded px-3 py-2" value="{{ old('title', $article->title) }}" required>
                <x-input-error :messages="$errors->get('title')" class="mt-1"/>
            </div>

            <div>
                <label class="block mb-1 font-medium">Slug</label>
                <input name="slug" class="w-full border rounded px-3 py-2" value="{{ old('slug', $article->slug) }}">
                <x-input-error :messages="$errors->get('slug')" class="mt-1"/>
            </div>

            <div>
                <label class="block mb-1 font-medium">Excerpt</label>
                <textarea name="excerpt" class="w-full border rounded px-3 py-2" rows="3">{{ old('excerpt', $article->excerpt) }}</textarea>
                <x-input-error :messages="$errors->get('excerpt')" class="mt-1"/>
            </div>

            <div>
                <label class="block mb-1 font-medium">Body</label>
                <textarea name="body" class="w-full border rounded px-3 py-2" rows="10" required>{{ old('body', $article->body) }}</textarea>
                <x-input-error :messages="$errors->get('body')" class="mt-1"/>
            </div>

            <div>
                <label class="block mb-1 font-medium">Cover image</label>
                @if($article->cover_image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/'.$article->cover_image) }}" alt="" class="max-h-40 rounded">
                    </div>
                @endif
                <input type="file" name="cover_image" accept="image/*">
                <x-input-error :messages="$errors->get('cover_image')" class="mt-1"/>
            </div>

            <div class="flex items-center gap-3">
                <label class="inline-flex items-center gap-2">
                    <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $article->is_published))>
                    <span>Published</span>
                </label>
                <input type="datetime-local" name="published_at"
                       value="{{ old('published_at', optional($article->published_at)->format('Y-m-d\TH:i')) }}"
                       class="border rounded px-2 py-1">
            </div>

            <div class="pt-2">
                <button class="px-4 py-2 bg-blue-600 text-white rounded">Update</button>
                <a href="{{ route('manage.articles.index') }}" class="ml-2 text-gray-600">Back</a>
            </div>
        </form>
    </div>
</x-app-layout>
