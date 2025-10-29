@php
    use Illuminate\Support\Facades\Storage;

    // 1) เริ่มจาก old('attributes') (กรณี validate fail แล้วย้อนกลับมา)
    $oldAttrs = collect(old('attributes', []));

    // 2) ถ้ายังว่าง และมี $product ให้ลองโหลดความสัมพันธ์ attributes มาใช้
    if ($oldAttrs->isEmpty() && isset($product)) {
        if (! $product->relationLoaded('attributes')) {
            $product->load('attributes');
        }
        if ($product->attributes) {
            $oldAttrs = $product->attributes->map(fn($a) => [
                'name'       => $a->name,
                'value'      => $a->value,
                'sort_order' => $a->sort_order,
            ]);
        }
    }

    // 3) บังคับให้เป็น Collection เสมอ กัน edge case
    if (! $oldAttrs instanceof \Illuminate\Support\Collection) {
        $oldAttrs = collect($oldAttrs);
    }
@endphp

@csrf

<div class="space-y-4">

  {{-- Name --}}
  <div>
    <label class="block text-sm font-medium mb-1">Name <span class="text-red-500">*</span></label>
    <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}"
           class="w-full border rounded p-2" required>
    @error('name')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
  </div>

  {{-- SKU + Price --}}
  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
      <label class="block text-sm font-medium mb-1">SKU</label>
      <input type="text" name="sku" value="{{ old('sku', $product->sku ?? '') }}"
             class="w-full border rounded p-2">
      @error('sku')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>
    <div>
      <label class="block text-sm font-medium mb-1">Price (THB) <span class="text-red-500">*</span></label>
      <input type="number" step="0.01" name="price" value="{{ old('price', $product->price ?? '') }}"
             class="w-full border rounded p-2" required>
      @error('price')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>
  </div>

  {{-- Status + Category --}}
  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
      <label class="block text-sm font-medium mb-1">Status</label>
      @php($statusVal = old('status', $product->status ?? 'active'))
      <select name="status" class="w-full border rounded p-2">
        <option value="active"   @selected($statusVal==='active')>Active</option>
        <option value="inactive" @selected($statusVal==='inactive')>Inactive</option>
      </select>
      @error('status')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>

    <div>
      <label class="block text-sm font-medium mb-1">Category</label>
      <select name="category_id" class="w-full border rounded p-2">
        <option value="">— None —</option>
        @foreach($categories as $c)
          <option value="{{ $c->id }}" @selected((int)old('category_id', $product->category_id ?? 0)===$c->id)>
            {{ $c->name }}
          </option>
        @endforeach
      </select>
      @error('category_id')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>
  </div>

  {{-- Brand --}}
  <div>
    <label class="block text-sm font-medium mb-1">Brand</label>
    <select name="brand_id" class="w-full border rounded p-2">
      <option value="">— None —</option>
      @foreach($brands as $b)
        <option value="{{ $b->id }}" @selected(old('brand_id', $product->brand_id ?? null)==$b->id)>
          {{ $b->name }}
        </option>
      @endforeach
    </select>
    @error('brand_id')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
  </div>

  {{-- Initial Stock --}}
  <div>
    <label class="block text-sm font-medium mb-1">Initial Stock (Qty)</label>
    <input type="number" min="0" name="qty"
           value="{{ old('qty', optional($product->stock ?? null)->qty) }}"
           class="w-full border rounded p-2">
    @error('qty')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
  </div>

  {{-- Cover image --}}
  <div>
    <label class="block text-sm font-medium mb-1">Cover image</label>
    <input type="file" name="cover_image" accept="image/*" class="border rounded px-3 py-2 w-full">
    @error('cover_image')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
    @if(!empty($product->cover_image))
      <img src="{{ $product->cover_url ?? Storage::disk('public')->url($product->cover_image) }}"
           class="mt-2 h-24 rounded object-cover" alt="cover">
    @endif
  </div>

  {{-- Attributes (dynamic) --}}
  <div>
    <div class="flex items-center justify-between mb-2">
      <label class="block text-sm font-semibold">Attributes</label>
      <button type="button" id="btn-add-attr"
              class="px-3 py-1.5 rounded bg-gray-800 text-white text-sm">+ Add attribute</button>
    </div>

    <div id="attr-rows" class="space-y-2">
      @foreach(($oldAttrs ?? collect()) as $i => $row)
        <div class="grid grid-cols-12 gap-2 attr-row">
          <input type="text" name="attributes[{{ $i }}][name]" placeholder="Name"
                 class="col-span-4 border rounded p-2"
                 value="{{ $row['name'] ?? '' }}" required>

          <input type="text" name="attributes[{{ $i }}][value]" placeholder="Value"
                 class="col-span-6 border rounded p-2"
                 value="{{ $row['value'] ?? '' }}">

          <input type="number" name="attributes[{{ $i }}][sort_order]" placeholder="Sort"
                 class="col-span-1 border rounded p-2"
                 value="{{ $row['sort_order'] ?? $i }}">

          <button type="button" class="col-span-1 px-3 py-2 rounded bg-red-500 text-white remove-attr">X</button>
        </div>
      @endforeach

      @if(($oldAttrs ?? collect())->isEmpty())
        {{-- เริ่มต้นไม่มีแถว: ให้ผู้ใช้กด + Add attribute เอง --}}
      @endif
    </div>

    @error('attributes')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
    @error('attributes.*.name')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
  </div>

  {{-- Actions --}}
  <div class="flex justify-end gap-2 pt-2">
    <a href="{{ route('manage.products.index') }}" class="px-3 py-2 bg-gray-200 rounded">Cancel</a>
    <button class="px-4 py-2 bg-blue-600 text-white rounded">{{ $submitLabel ?? 'Save' }}</button>
  </div>
</div>

{{-- Template + Script --}}
<template id="tpl-attr-row">
  <div class="grid grid-cols-12 gap-2 attr-row">
    <input type="text" name="__NAME__[idx][name]" placeholder="Name" class="col-span-4 border rounded p-2" required>
    <input type="text" name="__NAME__[idx][value]" placeholder="Value" class="col-span-6 border rounded p-2">
    <input type="number" name="__NAME__[idx][sort_order]" placeholder="Sort" class="col-span-1 border rounded p-2" value="0">
    <button type="button" class="col-span-1 px-3 py-2 rounded bg-red-500 text-white remove-attr">X</button>
  </div>
</template>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const container = document.getElementById('attr-rows');
  const btnAdd = document.getElementById('btn-add-attr');
  const tpl = document.getElementById('tpl-attr-row').innerHTML;
  let idx = container.querySelectorAll('.attr-row').length;

  const addRow = () => {
    const html = tpl.replaceAll('__NAME__', 'attributes').replaceAll('idx', idx++);
    const div = document.createElement('div');
    div.innerHTML = html.trim();
    container.appendChild(div.firstChild);
  };

  btnAdd?.addEventListener('click', addRow);

  container?.addEventListener('click', (e) => {
    if (e.target.classList.contains('remove-attr')) {
      e.target.closest('.attr-row')?.remove();
    }
  });
});
</script>
