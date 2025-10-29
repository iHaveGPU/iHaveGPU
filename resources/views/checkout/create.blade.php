<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl">Checkout</h2>
  </x-slot>

  <div class="max-w-5xl mx-auto py-6 grid grid-cols-1 md:grid-cols-3 gap-6">
    {{-- ที่อยู่จัดส่ง --}}
    <form method="POST" action="{{ route('orders.store') }}" class="md:col-span-2 bg-white p-6 rounded shadow">
      @csrf
      <h3 class="font-semibold mb-4">Shipping Address</h3>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-medium">Full name</label>
          <input name="ship_name" value="{{ old('ship_name', $prefill['name'] ?? '') }}"
                 class="mt-1 w-full border rounded p-2" required>
          @error('ship_name')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
          <label class="block text-sm font-medium">Phone</label>
          <input name="ship_phone" value="{{ old('ship_phone', $prefill['phone'] ?? '') }}"
                 class="mt-1 w-full border rounded p-2" required>
          @error('ship_phone')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="md:col-span-2">
          <label class="block text-sm font-medium">Address line 1</label>
          <input name="ship_address1" value="{{ old('ship_address1', $prefill['addr1'] ?? '') }}"
                 class="mt-1 w-full border rounded p-2" required>
          @error('ship_address1')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="md:col-span-2">
          <label class="block text-sm font-medium">Address line 2 (optional)</label>
          <input name="ship_address2" value="{{ old('ship_address2', $prefill['addr2'] ?? '') }}"
                 class="mt-1 w-full border rounded p-2">
          @error('ship_address2')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
          <label class="block text-sm font-medium">District</label>
          <input name="ship_district" value="{{ old('ship_district', $prefill['district'] ?? '') }}"
                 class="mt-1 w-full border rounded p-2" required>
          @error('ship_district')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
          <label class="block text-sm font-medium">Province</label>
          <input name="ship_province" value="{{ old('ship_province', $prefill['province'] ?? '') }}"
                 class="mt-1 w-full border rounded p-2" required>
          @error('ship_province')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
          <label class="block text-sm font-medium">Postcode</label>
          <input name="ship_postcode" value="{{ old('ship_postcode', $prefill['postcode'] ?? '') }}"
                 class="mt-1 w-full border rounded p-2" required>
          @error('ship_postcode')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
      </div>

      <div class="mt-6 flex justify-end">
        <button class="px-4 py-2 bg-blue-600 text-white rounded">Place order</button>
      </div>
    </form>

    {{-- สรุปรายการในตะกร้า --}}
    <div class="bg-white p-6 rounded shadow">
      <h3 class="font-semibold mb-4">Order Summary</h3>

      <div class="space-y-3">
        @foreach ($cartLines as $line)
          <div class="flex items-start justify-between">
            <div class="mr-3">
              <div class="font-medium">{{ $line['product']->name }}</div>
              <div class="text-xs text-gray-500">
                @if($line['product']->brand) {{ $line['product']->brand->name }} • @endif
                qty: {{ $line['qty'] }}
              </div>
            </div>
            <div class="text-right">
              <div>฿{{ number_format($line['price'],2) }}</div>
              <div class="text-sm text-gray-500">฿{{ number_format($line['total'],2) }}</div>
            </div>
          </div>
        @endforeach

        <hr>

        <div class="flex justify-between font-semibold">
          <div>Subtotal</div>
          <div>฿{{ number_format($subtotal, 2) }}</div>
        </div>

        <div class="flex justify-between">
          <div>Shipping</div>
          <div>฿0.00</div>
        </div>

        <div class="flex justify-between">
          <div>Discount</div>
          <div>฿0.00</div>
        </div>

        <hr>

        <div class="flex justify-between text-lg font-bold">
          <div>Total</div>
          <div>฿{{ number_format($total, 2) }}</div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
