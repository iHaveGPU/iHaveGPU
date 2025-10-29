@props(['product'])

<div class="group bg-white rounded-2xl shadow-sm ring-1 ring-gray-100 hover:shadow-md transition overflow-hidden">
  <a href="{{ route('products.show', $product) }}" class="block">
    <img src="{{ $product->cover_url }}"
         alt="{{ $product->name }}"
         class="w-full h-48 object-cover group-hover:scale-[1.02] transition" />
  </a>

  <div class="p-4">
    <div class="text-xs text-gray-500 flex items-center gap-2">
      @if($product->brand) <span class="truncate">{{ $product->brand->name }}</span>@endif
      @if($product->category)<span class="px-2 py-0.5 rounded-full bg-gray-100">{{ $product->category->name }}</span>@endif
    </div>

    <a href="{{ route('products.show', $product) }}" class="mt-1 block">
      <h3 class="font-semibold leading-tight line-clamp-2">{{ $product->name }}</h3>
    </a>

    @if($product->sku)
      <div class="text-xs text-gray-400 mt-1">SKU: {{ $product->sku }}</div>
    @endif

    <div class="mt-2 flex items-center justify-between">
      <div class="text-lg font-semibold">฿{{ number_format($product->price, 2) }}</div>

      {{-- ปุ่มเพิ่มลงตะกร้า: ให้แสดงเฉพาะลูกค้า และมี route --}}
      @auth
        @if(method_exists(auth()->user(),'isCustomer') && auth()->user()->isCustomer() && Route::has('cart.add'))
          <form method="POST" action="{{ route('cart.add', $product) }}">
            @csrf
            <button class="inline-flex items-center gap-1 px-3 py-1.5 text-sm rounded-lg bg-blue-600 text-white hover:bg-blue-700">
              เพิ่มลงตะกร้า
            </button>
          </form>
        @else
          <a href="{{ route('products.show', $product) }}"
             class="inline-flex items-center gap-1 px-3 py-1.5 text-sm rounded-lg bg-gray-900 text-white hover:bg-black">
             ดูสินค้า
          </a>
        @endif
      @else
        <a href="{{ route('products.show', $product) }}"
           class="inline-flex items-center gap-1 px-3 py-1.5 text-sm rounded-lg bg-gray-900 text-white hover:bg-black">
           ดูสินค้า
        </a>
      @endauth
    </div>
  </div>
</div>
