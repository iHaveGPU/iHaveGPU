<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800">{{ $product->name }}</h2>
  </x-slot>

  <div class="py-6 max-w-7xl mx-auto">
    @if (session('success'))
      <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
    @endif
    @if (session('error'))
      <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">{{ session('error') }}</div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

      {{-- ซ้าย: ภาพ/สเปก --}}
      <div class="lg:col-span-7">
        {{-- ภาพปก (ถ้ามี) --}}
        @if($product->cover_image)
          <img src="{{ Storage::disk('public')->url($product->cover_image) }}"
               class="w-full rounded-xl object-cover" alt="{{ $product->name }}">
        @endif

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

      {{-- ขวา: ชื่อ/ราคา/เพิ่มในตะกร้า --}}
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
            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium
                         {{ $product->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
              {{ $product->status === 'active' ? 'มีสินค้า' : 'ปิดขาย' }}
            </span>
          </div>

          <div class="mt-4 text-3xl font-extrabold">
            ฿{{ number_format($product->price, 2) }}
          </div>

          {{-- ฟอร์มเพิ่มในตะกร้า (ต้องเป็น role customer ตามระบบคุณ) --}}
          @auth
            @if(auth()->user()->isCustomer())
              <form class="mt-5 flex items-center gap-3"
                    method="POST" action="{{ route('cart.add', $product) }}">
                @csrf
                <label class="text-sm text-gray-600">จำนวน</label>
                @php $max = optional($product->stock)->qty ?? 999; @endphp
                <input type="number" name="qty" min="1" max="{{ $max }}" value="1"
                       class="w-24 border rounded p-2">

                <button class="px-4 py-2 rounded bg-red-600 text-white hover:bg-red-700">
                  เพิ่มในตะกร้า
                </button>
              </form>
              @if(optional($product->stock)->qty !== null)
                <p class="mt-2 text-xs text-gray-500">คงเหลือ: {{ $product->stock->qty }} ชิ้น</p>
              @endif
            @else
              <p class="mt-5 text-sm text-gray-600">
                ต้องเป็นบัญชีลูกค้าเพื่อเพิ่มลงตะกร้า
              </p>
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
