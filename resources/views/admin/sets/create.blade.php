<x-app-layout>
  <x-slot name="header"><h2 class="font-semibold text-xl">New Computer Set</h2></x-slot>

  <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <form method="POST" action="{{ route('manage.sets.store') }}" enctype="multipart/form-data" class="space-y-6">
      @csrf

      <div>
        <label class="block text-sm mb-1">Name</label>
        <input type="text" name="name" class="w-full border rounded p-2" value="{{ old('name') }}" required>
        @error('name')<div class="text-sm text-red-600 mt-1">{{ $message }}</div>@enderror
      </div>

      <div>
        <label class="block text-sm mb-1">Slug (optional)</label>
        <input type="text" name="slug" class="w-full border rounded p-2" value="{{ old('slug') }}">
        @error('slug')<div class="text-sm text-red-600 mt-1">{{ $message }}</div>@enderror
      </div>

      <div>
        <label class="block text-sm mb-1">Description</label>
        <textarea name="description" class="w-full border rounded p-2" rows="3">{{ old('description') }}</textarea>
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Cover image</label>
        <input type="file" name="cover_image" accept="image/*" class="border rounded px-3 py-2 w-full">
        @error('cover_image')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
      </div>

      <div>
        <div class="font-semibold mb-2">Products in set</div>
        <div class="max-h-80 overflow-auto border rounded divide-y">
          @foreach($products as $prod)
            <label class="flex items-center gap-3 p-2">
              <input type="checkbox" name="product_ids[]" value="{{ $prod->id }}">
              <div class="flex-1">
                <div class="font-medium">{{ $prod->name }}</div>
                <div class="text-xs text-gray-500">SKU: {{ $prod->sku }} — {{ number_format($prod->price,2) }}</div>
              </div>
              <div class="flex items-center gap-2">
                <span class="text-xs text-gray-600">Qty</span>
                <input type="number" name="qtys[{{ $prod->id }}]" value="1" min="1" class="w-20 border rounded p-1">
              </div>
            </label>
          @endforeach
        </div>
        @error('product_ids.*')<div class="text-sm text-red-600 mt-1">{{ $message }}</div>@enderror
      </div>

      <div class="flex justify-end gap-2">
        <a href="{{ route('manage.sets.index') }}" class="px-3 py-2 bg-gray-200 rounded">Cancel</a>
        <button class="px-4 py-2 bg-blue-600 text-white rounded">Create</button>
      </div>
    </form>
  </div>
</x-app-layout>
