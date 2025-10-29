{{-- resources/views/orders/show.blade.php --}}
<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center justify-between">
      <div>
        <h2 class="font-semibold text-xl">
          Order {{ $order->number ?? ('#'.$order->id) }}
        </h2>
        <p class="text-sm text-gray-500">
          Placed on {{ $order->created_at?->timezone(config('app.timezone'))->format('d M Y H:i') }}
          · Status: <span class="font-medium capitalize">{{ $order->status }}</span>
        </p>
      </div>
      <a href="{{ url()->previous() }}" class="px-3 py-2 bg-gray-200 rounded text-sm">Back</a>
    </div>
  </x-slot>

  <div class="max-w-5xl mx-auto space-y-6">

    {{-- Shipping --}}
    <div class="bg-white rounded shadow p-4">
      <h3 class="font-semibold mb-2">Shipping details</h3>
      <div class="text-gray-700">
        <div>{{ $order->ship_name }}</div>
        <div>{{ $order->ship_phone }}</div>
        <div>
          {{ $order->ship_address1 }}
          @if($order->ship_address2), {{ $order->ship_address2 }} @endif
          @if($order->ship_district), {{ $order->ship_district }} @endif
          @if($order->ship_province), {{ $order->ship_province }} @endif
          @if($order->ship_postcode) {{ $order->ship_postcode }} @endif
        </div>
      </div>
    </div>

    {{-- Items --}}
    <div class="bg-white rounded shadow p-4 overflow-x-auto">
      <h3 class="font-semibold mb-3">Items</h3>
      <table class="min-w-full text-sm">
        <thead>
          <tr class="text-left border-b">
            <th class="py-2">Product</th>
            <th class="py-2">Price</th>
            <th class="py-2">Qty</th>
            <th class="py-2 text-right">Line total</th>
          </tr>
        </thead>
        <tbody>
          @foreach($order->items as $item)
            <tr class="border-b">
              <td class="py-3">
                <div class="flex items-center gap-3">
                  <img
                    src="{{ $item->product->cover_url ?? asset('images/placeholder-product.png') }}"
                    class="h-12 w-12 object-cover rounded border" alt="">
                  <div>
                    <div class="font-medium">
                      {{ $item->product->name ?? 'Product #'.$item->product_id }}
                    </div>
                    @if($item->product?->sku)
                      <div class="text-xs text-gray-500">SKU: {{ $item->product->sku }}</div>
                    @endif
                  </div>
                </div>
              </td>
              <td class="py-3">{{ number_format($item->price, 2) }}</td>
              <td class="py-3">{{ (int)$item->qty }}</td>
              <td class="py-3 text-right">{{ number_format($item->price * $item->qty, 2) }}</td>
            </tr>
          @endforeach
        </tbody>
        <tfoot>
          @php
            // รองรับได้ทั้ง schema เดิม (subtotal/total) หรือ grand_total
            $subtotal = $order->subtotal ?? $order->grand_total ?? 0;
            $total    = $order->total    ?? $order->grand_total ?? $subtotal;
          @endphp
          <tr>
            <td colspan="3" class="py-3 text-right font-medium">Subtotal</td>
            <td class="py-3 text-right font-medium">{{ number_format($subtotal, 2) }}</td>
          </tr>
          <tr>
            <td colspan="3" class="py-3 text-right text-lg font-semibold">Total</td>
            <td class="py-3 text-right text-lg font-semibold">{{ number_format($total, 2) }}</td>
          </tr>
        </tfoot>
      </table>
    </div>

    @if($order->status === 'pending')
      <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 rounded p-4">
        Your order has been placed and is pending review. Staff/Admin can now see it in the manage panel.
      </div>
    @endif
  </div>
</x-app-layout>
