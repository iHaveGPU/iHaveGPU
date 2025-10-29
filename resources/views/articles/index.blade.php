<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl">บทความ</h2></x-slot>

    <div class="max-w-6xl mx-auto mt-4">
        <form class="mb-4">
            <input name="q" value="{{ request('q') }}" placeholder="ค้นหา..."
                   class="border rounded px-3 py-2 w-64">
            <button class="px-3 py-2 bg-gray-800 text-white rounded">ค้นหา</button>
        </form>

        <div class="grid md:grid-cols-3 gap-4">
            @forelse($articles as $a)
                <a href="{{ route('articles.show', $a) }}" class="block bg-white p-4 rounded shadow">
                    @if($a->cover_image)
                        <img src="{{ asset('storage/'.$a->cover_image) }}" class="rounded mb-2">
                    @endif
                    <div class="text-lg font-semibold mb-1">{{ $a->title }}</div>
                    <div class="text-gray-500 text-sm">{{ optional($a->published_at)->format('d M Y') }}</div>
                    <p class="text-gray-700 mt-2">{{ $a->excerpt }}</p>
                </a>
            @empty
                <p class="text-gray-500">ยังไม่มีบทความ</p>
            @endforelse
        </div>

        <div class="mt-4">{{ $articles->links() }}</div>
    </div>
</x-app-layout>
