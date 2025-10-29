@csrf
<div class="space-y-4">
  <div>
    <label class="block text-sm font-medium mb-1">Name</label>
    <input type="text" name="name" class="w-full border rounded p-2"
           value="{{ old('name', $category->name ?? '') }}" required>
    @error('name')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
  </div>

  <div>
    <label class="block text-sm font-medium mb-1">Slug (optional)</label>
    <input type="text" name="slug" class="w-full border rounded p-2"
           value="{{ old('slug', $category->slug ?? '') }}">
    @error('slug')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
  </div>

  <div class="grid grid-cols-2 gap-4">
    <div>
      <label class="block text-sm font-medium mb-1">Sort order</label>
      <input type="number" name="sort_order" min="0" class="w-full border rounded p-2"
             value="{{ old('sort_order', $category->sort_order ?? 0) }}">
    </div>
    <div class="flex items-center gap-2 mt-6">
      <input type="checkbox" name="is_active" value="1"
             {{ old('is_active', ($category->is_active ?? true)) ? 'checked' : '' }}>
      <span>Active</span>
    </div>
  </div>

  <div class="flex justify-end gap-2">
    <a href="{{ route('manage.categories.index') }}" class="px-3 py-2 bg-gray-200 rounded">Cancel</a>
    <button class="px-4 py-2 bg-blue-600 text-white rounded">{{ $submitLabel ?? 'Save' }}</button>
  </div>
</div>
