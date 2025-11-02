{{-- resources/views/checkout/create.blade.php --}}
<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl">Checkout</h2>
  </x-slot>

  <div class="max-w-5xl mx-auto py-6 grid grid-cols-1 md:grid-cols-3 gap-6">
    {{-- ฟอร์มที่อยู่จัดส่ง --}}
    <form method="POST" action="{{ route('orders.store') }}"
          class="md:col-span-2 bg-white p-6 rounded shadow"
          x-data="{
            fill(){
              $refs.name.value     = @js($prefill['name']);
              $refs.phone.value    = @js($prefill['phone']);
              $refs.addr1.value    = @js($prefill['addr1']);
              $refs.addr2.value    = @js($prefill['addr2']);
              $refs.district.value = @js($prefill['district']);
              $refs.province.value = @js($prefill['province']);
              $refs.postcode.value = @js($prefill['postcode']);
            }
          }">
      @csrf

      <div class="flex items-center justify-between mb-4">
        <h3 class="font-semibold">Shipping Address</h3>
        <button type="button" class="px-3 py-1 text-sm bg-gray-100 rounded" @click="fill()">
          Use my profile
        </button>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-medium">Full name</label>
          <input x-ref="name" name="ship_name"
                 value="{{ old('ship_name', $prefill['name']) }}"
                 class="mt-1 w-full border rounded p-2" required>
          @error('ship_name')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
          <label class="block text-sm font-medium">Phone</label>
          <input x-ref="phone" name="ship_phone"
                 value="{{ old('ship_phone', $prefill['phone']) }}"
                 class="mt-1 w-full border rounded p-2" required>
          @error('ship_phone')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="md:col-span-2">
          <label class="block text-sm font-medium">Address line 1</label>
          <input x-ref="addr1" name="ship_address1"
                 value="{{ old('ship_address1', $prefill['addr1']) }}"
                 class="mt-1 w-full border rounded p-2" required>
          @error('ship_address1')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="md:col-span-2">
          <label class="block text-sm font-medium">Address line 2 (optional)</label>
          <input x-ref="addr2" name="ship_address2"
                 value="{{ old('ship_address2', $prefill['addr2']) }}"
                 class="mt-1 w-full border rounded p-2">
          @error('ship_address2')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
          <label class="block text-sm font-medium">District</label>
          <input x-ref="district" name="ship_district"
                 value="{{ old('ship_district', $prefill['district']) }}"
                 class="mt-1 w-full border rounded p-2" required>
          @error('ship_district')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
          <label class="block text-sm font-medium">Province</label>
          <input x-ref="province" name="ship_province"
                 value="{{ old('ship_province', $prefill['province']) }}"
                 class="mt-1 w-full border rounded p-2" required>
          @error('ship_province')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
          <label class="block text-sm font-medium">Postcode</label>
          <input x-ref="postcode" name="ship_postcode"
                 value="{{ old('ship_postcode', $prefill['postcode']) }}"
                 class="mt-1 w-full border rounded p-2" required>
          @error('ship_postcode')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
      </div>

      <div class="mt-6 flex justify-end">
        <button class="px-4 py-2 bg-blue-600 text-white rounded">Place order</button>
      </div>
    </form>

    {{-- สรุปตะกร้า --}}
    <div class="bg-white p-6 rounded shadow">
      <h3 class="font-semibold mb-4">Order Summary</h3>
      @foreach ($cartLines as $line)
        <div class="flex items-start justify-between mb-2">
          <div class="mr-3">
            <div class="font-medium">{{ $line['product']->name }}</div>
            <div class="text-xs text-gray-500">qty: {{ $line['qty'] }}</div>
          </div>
          <div class="text-right">
            <div>฿{{ number_format($line['price'],2) }}</div>
            <div class="text-sm text-gray-500">฿{{ number_format($line['total'],2) }}</div>
          </div>
        </div>
      @endforeach
      <hr class="my-3">
      <div class="flex justify-between font-semibold">
        <div>Total</div>
        <div>฿{{ number_format($total, 2) }}</div>
      </div>
    </div>
  </div>
</x-app-layout>
