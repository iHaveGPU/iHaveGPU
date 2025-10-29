<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl">{{ $article->title }}</h2></x-slot>

    <div class="max-w-3xl mx-auto mt-4 bg-white p-6 rounded shadow">
        @if($article->cover_image)
            <img src="{{ asset('storage/'.$article->cover_image) }}" class="rounded mb-4">
        @endif
        <div class="text-gray-500 text-sm mb-4">
            เผยแพร่: {{ optional($article->published_at)->format('d M Y H:i') }}
        </div>
        @if($article->excerpt)
            <p class="text-gray-700 mb-4">{{ $article->excerpt }}</p>
        @endif
        <article class="prose max-w-none">{!! nl2br(e($article->body)) !!}</article>
    </div>
</x-app-layout>
