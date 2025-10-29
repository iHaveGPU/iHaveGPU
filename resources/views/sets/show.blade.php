<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center gap-3">
      {{-- รูปหน้าปกของชุด (ถ้ามี) --}}
      @if($set->cover_url)
        <img src="{{ $set->cover_url }}" alt="{{ $set->name }}"
             class="h-10 w-10 rounded object-cover border">
      @endif
      <h2 class="font-semibold text-xl">{{ $set->name }}</h2>
    </div>
  </x-slot>

  <div class="max-w-6xl mx-auto">
    @if($set->description)
      <div class="bg-white rounded shadow p-4 mb-4">
        <p class="text-gray-700">{{ $set->description }}</p>
      </div>
    @endif

    {{-- รายการสินค้าในชุด (แบบการ์ด + รูป) --}}
    <div class="bg-white rounded shadow p-4 mb-4">
      @php
        $setTotal = $set->products->sum(fn($p) => (int)($p->pivot->qty ?? 1) * $p->price);
      @endphp
      <div class="text-lg font-semibold mb-3">
        Set price (sum of items): {{ number_format($setTotal, 2) }}
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @foreach ($set->products as $p)
          <div class="flex gap-3 p-3 border rounded">
            <a href="{{ route('products.show', $p) }}" class="shrink-0">
              <img src="{{ $p->cover_url ?? asset('images/placeholder-product.png') }}"
                   alt="{{ $p->name }}"
                   class="h-20 w-20 rounded object-cover border">
            </a>
            <div class="flex-1">
              <a href="{{ route('products.show', $p) }}"
                 class="font-semibold hover:underline">{{ $p->name }}</a>
              @if($p->sku)
                <div class="text-xs text-gray-500">SKU: {{ $p->sku }}</div>
              @endif
              <div class="mt-1 font-medium">{{ number_format($p->price,2) }}</div>
              @if($p->pivot?->qty)
                <div class="text-xs text-gray-500">Qty in set: {{ (int)$p->pivot->qty }}</div>
              @endif
            </div>
          </div>
        @endforeach
      </div>
    </div>

    {{-- สรุป + Add whole set to cart --}}
    <div class="bg-white rounded shadow p-4">
      <h3 class="font-semibold text-lg mb-3">Items in this set</h3>
      <ul class="space-y-1 mb-4">
        @foreach($set->products as $p)
          <li class="flex justify-between">
            <span>{{ $p->name }} × {{ (int)($p->pivot->qty ?? 1) }}</span>
            <span>{{ number_format($p->price, 2) }}</span>
          </li>
        @endforeach
      </ul>

      <div class="text-xl font-semibold mb-4">
        Set price: {{ number_format($setTotal, 2) }}
      </div>

      @auth
        @if(auth()->user()->isCustomer() && Route::has('cart.addSet'))
          <form method="POST" action="{{ route('cart.addSet', $set) }}" class="flex items-center gap-3">
            @csrf
            <label class="text-sm text-gray-700">Set quantity</label>
            <input type="number" name="set_qty" min="1" value="1" class="w-24 border rounded p-2">
            <button class="px-4 py-2 bg-blue-600 text-white rounded">
              Add whole set to cart
            </button>
          </form>
        @endif
      @endauth

      @if($errors->has('cart'))
        <div class="mt-3 p-3 bg-red-100 text-red-700 rounded">
          {{ $errors->first('cart') }}
        </div>
      @endif
    </div>
  </div>
</x-app-layout>
