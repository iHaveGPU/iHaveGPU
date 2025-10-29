<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Create Article</h2>
    </x-slot>

    <div class="max-w-3xl mx-auto mt-4 bg-white p-6 rounded shadow">
        <form method="POST" action="{{ route('manage.articles.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label class="block mb-1 font-medium">Title</label>
                <input name="title" class="w-full border rounded px-3 py-2" required>
                <x-input-error :messages="$errors->get('title')" class="mt-1"/>
            </div>

            <div>
                <label class="block mb-1 font-medium">Slug (optional)</label>
                <input name="slug" class="w-full border rounded px-3 py-2" placeholder="auto-from-title if blank">
                <x-input-error :messages="$errors->get('slug')" class="mt-1"/>
            </div>

            <div>
                <label class="block mb-1 font-medium">Excerpt</label>
                <textarea name="excerpt" class="w-full border rounded px-3 py-2" rows="3"></textarea>
                <x-input-error :messages="$errors->get('excerpt')" class="mt-1"/>
            </div>

            <div>
                <label class="block mb-1 font-medium">Body</label>
                <textarea name="body" class="w-full border rounded px-3 py-2" rows="10" required></textarea>
                <x-input-error :messages="$errors->get('body')" class="mt-1"/>
            </div>

            <div>
                <label class="block mb-1 font-medium">Cover image</label>
                <input type="file" name="cover_image" accept="image/*">
                <x-input-error :messages="$errors->get('cover_image')" class="mt-1"/>
            </div>

            <div class="flex items-center gap-3">
                <label class="inline-flex items-center gap-2">
                    <input type="checkbox" name="is_published" value="1">
                    <span>Publish now</span>
                </label>
                <input type="datetime-local" name="published_at" class="border rounded px-2 py-1">
            </div>

            <div class="pt-2">
                <button class="px-4 py-2 bg-blue-600 text-white rounded">Save</button>
                <a href="{{ route('manage.articles.index') }}" class="ml-2 text-gray-600">Cancel</a>
            </div>
        </form>
    </div>
</x-app-layout>
