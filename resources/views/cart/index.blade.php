<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl">Cart</h2>
  </x-slot>

  <div class="max-w-6xl mx-auto bg-white p-4 rounded shadow">
    @if(session('success'))
      <div class="mb-3 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
    @endif

    <div class="overflow-x-auto">
      <table class="min-w-full text-left">
        <thead>
          <tr class="border-b">
            <th class="py-2">Product</th>
            <th class="py-2">Price</th>
            <th class="py-2">Qty</th>
            <th class="py-2">Subtotal</th>
            <th class="py-2 text-right">Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse($lines as $line)
            @php $p = $line['product']; @endphp
            <tr class="border-b align-top">
              <td class="py-3">
                <div class="flex items-center gap-3">
                  <img
                    src="{{ $p->cover_url ?? asset('images/placeholder-product.png') }}"
                    alt="{{ $p->name }}"
                    class="h-14 w-14 object-cover rounded border">
                  <div>
                    <div class="font-medium">{{ $p->name }}</div>
                    @if($p->sku)
                      <div class="text-xs text-gray-500">SKU: {{ $p->sku }}</div>
                    @endif
                  </div>
                </div>
              </td>
              <td class="py-3">{{ number_format($p->price, 2) }}</td>
              <td class="py-3">
                <form class="flex items-center gap-2"
                      method="POST" action="{{ route('cart.update', $p) }}">
                  @csrf @method('PATCH')
                  <input type="number" name="qty" min="0" value="{{ $line['qty'] }}"
                         class="w-20 border rounded px-2 py-1">
                  <button class="px-3 py-1 bg-blue-600 text-white rounded">Update</button>
                </form>
              </td>
              <td class="py-3 font-medium">{{ number_format($line['subtotal'], 2) }}</td>
              <td class="py-3 text-right">
                <form method="POST" action="{{ route('cart.remove', $p) }}">
                  @csrf @method('DELETE')
                  <button class="px-3 py-1 bg-red-600 text-white rounded">Remove</button>
                </form>
              </td>
            </tr>
          @empty
            <tr><td colspan="5" class="py-8 text-center text-gray-500">Cart is empty.</td></tr>
          @endforelse
        </tbody>
        @if(count($lines))
          <tfoot>
            <tr>
              <td colspan="3" class="py-3 text-right font-semibold">Total</td>
              <td class="py-3 font-semibold">{{ number_format($total, 2) }}</td>
              <td></td>
            </tr>
          </tfoot>
        @endif
      </table>
    </div>

    @if(count($lines))
      <div class="mt-4">
        <a href="{{ route('orders.create') }}" class="px-4 py-2 bg-emerald-600 text-white rounded">
          Checkout
        </a>
      </div>
    @endif
  </div>
</x-app-layout>
