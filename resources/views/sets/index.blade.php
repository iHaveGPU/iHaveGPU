<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl">Computer Sets</h2>
  </x-slot>

  <div class="py-6 max-w-6xl mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
    @forelse($sets as $set)
      <a href="{{ route('sets.show', $set) }}"
         class="bg-white rounded-lg shadow hover:shadow-md transition block overflow-hidden">
        {{-- รูปหน้าปก --}}
        <img src="{{ $set->cover_url }}"
             alt="{{ $set->name }}"
             class="w-full h-40 object-cover">

        <div class="p-4">
          <div class="text-lg font-semibold mb-1 line-clamp-1">{{ $set->name }}</div>
          @php($desc = \Illuminate\Support\Str::limit($set->description, 80))
          @if($desc)
            <div class="text-gray-500 text-sm line-clamp-2">{{ $desc }}</div>
          @endif
          <div class="text-sm mt-2 text-gray-600">Items: {{ $set->products_count }}</div>
        </div>
      </a>
    @empty
      <p class="col-span-full text-center text-gray-500">No sets.</p>
    @endforelse
  </div>

  <div class="max-w-6xl mx-auto mt-4">
    {{ $sets->links() }}
  </div>
</x-app-layout>
