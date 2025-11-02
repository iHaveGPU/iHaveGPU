<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800">{{ $product->name }}</h2>
  </x-slot>

  <div class="py-6 max-w-7xl mx-auto">
    @if (session('success'))
      <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
    @endif
    @if ($errors->has('cart'))
      <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">{{ $errors->first('cart') }}</div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

      {{-- LEFT: ภาพ + คุณสมบัติ --}}
      <div class="lg:col-span-7">
        {{-- รูปสินค้าพร้อม overlay เมื่อหมดสต็อก --}}
        <div class="relative rounded-xl overflow-hidden bg-white shadow">
          <img
  src="{{ $product->cover_image_url }}"
  alt="{{ $product->name }}"
  class="w-full object-cover {{ $product->in_stock ? '' : 'opacity-60 grayscale' }}"
  onerror="this.src='{{ asset('images/placeholder-product.png') }}';"
/>

          @unless($product->in_stock)
            <div class="absolute inset-0 flex items-center justify-center">
              <span class="px-4 py-2 rounded-full bg-gray-900/80 text-white text-sm tracking-wide">
                สินค้าหมด (Out of Stock)
              </span>
            </div>
          @endunless
        </div>

        {{-- ตารางคุณสมบัติ --}}
        <div class="mt-6 bg-white rounded-xl shadow">
          <div class="px-4 py-3 border-b text-lg font-semibold">คุณสมบัติสินค้า</div>
          <div class="p-0 overflow-x-auto">
            <table class="min-w-full text-sm">
              <tbody class="[&>tr:nth-child(odd)]:bg-gray-50">
                @if($product->brand)
                  <tr>
                    <td class="px-4 py-3 w-48 text-gray-600">Brand</td>
                    <td class="px-4 py-3">{{ $product->brand->name }}</td>
                  </tr>
                @endif
                @if($product->sku)
                  <tr>
                    <td class="px-4 py-3 text-gray-600">SKU</td>
                    <td class="px-4 py-3">{{ $product->sku }}</td>
                  </tr>
                @endif

                @forelse($product->attributes as $attr)
                  <tr>
                    <td class="px-4 py-3 text-gray-600">{{ $attr->name }}</td>
                    <td class="px-4 py-3">{{ $attr->value }}</td>
                  </tr>
                @empty
                  {{-- ไม่มี attribute เพิ่มเอง --}}
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>

      {{-- RIGHT: ข้อมูลหลัก + ใส่ตะกร้า --}}
      <div class="lg:col-span-5">
        <div class="bg-white rounded-xl shadow p-5">
          <div class="flex items-start justify-between gap-4">
            <div>
              <div class="text-sm text-gray-500">
                แบรนด์: {{ $product->brand->name ?? '—' }}
                @if($product->sku) | รหัสสินค้า: {{ $product->sku }} @endif
              </div>
              <h1 class="mt-1 text-2xl font-bold leading-snug">{{ $product->name }}</h1>
            </div>

            {{-- สถานะขาย/คงเหลือ --}}
            <div class="text-right space-y-1">
              @if($product->in_stock)
                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                  มีสินค้า
                </span>
                <div class="text-xs text-gray-600">
                  คงเหลือ:
                  @php $qty = $product->stock_qty; @endphp
                  <span class="font-medium {{ $qty <= 5 ? 'text-yellow-700' : 'text-gray-800' }}">
                    {{ $qty }} ชิ้น
                  </span>
                  @if($qty <= 5)
                    <span class="ml-1 px-1.5 py-0.5 rounded bg-yellow-100 text-yellow-800 text-[10px]">เหลือน้อย</span>
                  @endif
                </div>
              @else
                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-200 text-gray-700">
                  สินค้าหมด
                </span>
              @endif
            </div>
          </div>

          <div class="mt-4 text-3xl font-extrabold">
            ฿{{ number_format($product->price, 2) }}
          </div>

          {{-- ฟอร์มเพิ่มตะกร้า --}}
          @auth
            @if(auth()->user()->isCustomer())
              <form class="mt-5 flex items-center gap-3"
                    method="POST" action="{{ route('cart.add', $product) }}">
                @csrf
                <label class="text-sm text-gray-600">จำนวน</label>

                <input
                  type="number" name="qty" min="1"
                  value="1"
                  class="w-24 border rounded p-2"
                  @unless($product->in_stock) disabled @endunless
                  @if($product->in_stock) max="{{ $product->stock_qty }}" @endif
                >

                @if($product->in_stock)
                  <button class="px-4 py-2 rounded bg-red-600 text-white hover:bg-red-700">
                    เพิ่มในตะกร้า
                  </button>
                @else
                  <button type="button"
                          class="px-4 py-2 rounded bg-gray-300 text-white cursor-not-allowed"
                          disabled>
                    สินค้าหมด
                  </button>
                @endif
              </form>
            @else
              <p class="mt-5 text-sm text-gray-600">ต้องเป็นบัญชีลูกค้าเพื่อเพิ่มลงตะกร้า</p>
            @endif
          @else
            <a href="{{ route('login') }}" class="mt-5 inline-block px-4 py-2 rounded bg-blue-600 text-white">
              เข้าสู่ระบบเพื่อสั่งซื้อ
            </a>
          @endauth
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
