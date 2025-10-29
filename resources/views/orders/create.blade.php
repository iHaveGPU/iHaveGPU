<x-app-layout>
  <x-slot name="header"><h2 class="font-semibold text-xl">Checkout</h2></x-slot>

  <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6">
    {{-- Shipping form --}}
    <form method="POST" action="{{ route('orders.store') }}" class="md:col-span-2 bg-white p-6 rounded shadow space-y-4">
      @csrf
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="text-sm">Full name</label>
          <input name="ship_name" class="w-full border rounded p-2"
                 value="{{ old('ship_name', $shipping['ship_name']) }}" required>
          @error('ship_name')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
        </div>
        <div>
          <label class="text-sm">Phone</label>
          <input name="ship_phone" class="w-full border rounded p-2"
                 value="{{ old('ship_phone', $shipping['ship_phone']) }}" required>
          @error('ship_phone')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
        </div>

        <div class="md:col-span-2">
          <label class="text-sm">Address line 1</label>
          <input name="ship_address1" class="w-full border rounded p-2"
                 value="{{ old('ship_address1', $shipping['ship_address1']) }}" required>
          @error('ship_address1')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
        </div>
        <div class="md:col-span-2">
          <label class="text-sm">Address line 2</label>
          <input name="ship_address2" class="w-full border rounded p-2"
                 value="{{ old('ship_address2', $shipping['ship_address2']) }}">
        </div>

        <div>
          <label class="text-sm">District</label>
          <input name="ship_district" class="w-full border rounded p-2"
                 value="{{ old('ship_district', $shipping['ship_district']) }}" required>
          @error('ship_district')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
        </div>
        <div>
          <label class="text-sm">Province</label>
          <input name="ship_province" class="w-full border rounded p-2"
                 value="{{ old('ship_province', $shipping['ship_province']) }}" required>
          @error('ship_province')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
        </div>
        <div>
          <label class="text-sm">Postcode</label>
          <input name="ship_postcode" class="w-full border rounded p-2"
                 value="{{ old('ship_postcode', $shipping['ship_postcode']) }}" required>
          @error('ship_postcode')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
        </div>
      </div>

      <div>
        <div class="text-sm font-semibold mb-1">Payment</div>
        <label class="inline-flex items-center gap-2">
          <input type="radio" name="payment_method" value="cod" {{ old('payment_method','cod')==='cod'?'checked':'' }}>
          <span>Cash on delivery</span>
        </label>
        <label class="inline-flex items-center gap-2 ms-6">
          <input type="radio" name="payment_method" value="test" {{ old('payment_method')==='test'?'checked':'' }}>
          <span>Test (mark as paid)</span>
        </label>
      </div>

      <button class="px-4 py-2 bg-blue-600 text-white rounded">Place order</button>
    </form>

    {{-- Order summary --}}
    <div class="bg-white p-6 rounded shadow">
      <div class="font-semibold mb-3">Order summary</div>
      <ul class="space-y-2">
        @foreach($lines as $line)
          <li class="flex justify-between text-sm">
            <span>{{ $line['product']->name }} × {{ $line['qty'] }}</span>
            <span>{{ number_format($line['subtotal'],2) }}</span>
          </li>
        @endforeach
      </ul>
      <div class="mt-3 border-t pt-3 flex justify-between font-semibold">
        <span>Subtotal</span><span>{{ number_format($subtotal,2) }}</span>
      </div>
    </div>
  </div>
</x-app-layout>
