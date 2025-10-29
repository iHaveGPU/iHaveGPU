<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl">Order placed</h2>
  </x-slot>

  <div class="max-w-3xl mx-auto bg-white rounded shadow p-6">
    <p class="mb-4">Thank you! Your order has been placed.</p>

    <div class="mb-2">Order No.: <span class="font-semibold">{{ $order->number }}</span></div>
    <div class="mb-4 text-sm text-gray-600">Status: {{ ucfirst($order->status) }}</div>

    <div class="mb-4">
      <div class="font-semibold">Shipping to</div>
      <div>{{ $order->customer_name }}</div>
      @if($order->customer_phone)<div>Tel: {{ $order->customer_phone }}</div>@endif
      @if($order->customer_email)<div>Email: {{ $order->customer_email }}</div>@endif
      @if($order->shipping_address)
        <div class="mt-1 whitespace-pre-line">{{ $order->shipping_address }}</div>
      @endif
    </div>

    <div class="mb-4">
      <div class="font-semibold mb-2">Items</div>
      <table class="w-full text-left">
        <thead>
          <tr class="border-b">
            <th class="py-2">Product</th>
            <th class="py-2">Price</th>
            <th class="py-2">Qty</th>
            <th class="py-2">Subtotal</th>
          </tr>
        </thead>
        <tbody>
          @foreach($order->items as $it)
            <tr class="border-b">
              <td class="py-2">{{ $it->name }}</td>
              <td class="py-2">{{ number_format($it->price, 2) }}</td>
              <td class="py-2">{{ $it->qty }}</td>
              <td class="py-2">{{ number_format($it->subtotal, 2) }}</td>
            </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <td colspan="3" class="py-2 text-right font-semibold">Total</td>
            <td class="py-2 font-semibold">{{ number_format($order->grand_total, 2) }}</td>
          </tr>
        </tfoot>
      </table>
    </div>

    <div class="flex gap-2">
      <a href="{{ route('products.index') }}" class="px-3 py-2 bg-gray-200 rounded">Continue shopping</a>
    </div>
  </div>
</x-app-layout>
