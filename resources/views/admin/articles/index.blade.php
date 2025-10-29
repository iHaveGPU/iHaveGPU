<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl">Articles</h2>
            <a href="{{ route('manage.articles.create') }}"
               class="px-3 py-2 bg-blue-600 text-white rounded">Create</a>
        </div>
    </x-slot>

    @if(session('success'))
        <div class="max-w-6xl mx-auto mt-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="max-w-6xl mx-auto mt-4 bg-white p-4 rounded shadow">
        <form class="flex gap-3 mb-4">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Search..."
                   class="border rounded px-3 py-2 w-64">
            <select name="status" class="border rounded px-3 py-2">
                <option value="">All</option>
                <option value="published" @selected(request('status')==='published')>Published</option>
                <option value="draft" @selected(request('status')==='draft')>Draft</option>
            </select>
            <button class="px-3 py-2 bg-gray-800 text-white rounded">Filter</button>
        </form>

        <table class="w-full text-left">
            <thead>
                <tr class="border-b">
                    <th class="py-2">Title</th>
                    <th>Slug</th>
                    <th>Status</th>
                    <th>Updated</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
            @forelse($articles as $a)
                <tr class="border-b">
                    <td class="py-2 font-medium">{{ $a->title }}</td>
                    <td class="text-gray-600">{{ $a->slug }}</td>
                    <td>
                        @if($a->is_published)
                            <span class="text-green-700">Published</span>
                        @else
                            <span class="text-gray-500">Draft</span>
                        @endif
                    </td>
                    <td class="text-gray-600">{{ $a->updated_at->diffForHumans() }}</td>
                    <td class="text-right">
                        <a href="{{ route('manage.articles.edit', $a) }}" class="text-blue-600 mr-3">Edit</a>
                        <form action="{{ route('manage.articles.destroy', $a) }}" method="POST" class="inline"
                              onsubmit="return confirm('Delete this article?')">
                            @csrf @method('DELETE')
                            <button class="text-red-600">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="py-6 text-center text-gray-500">No articles.</td></tr>
            @endforelse
            </tbody>
        </table>

        <div class="mt-4">{{ $articles->links() }}</div>
    </div>
</x-app-layout>
