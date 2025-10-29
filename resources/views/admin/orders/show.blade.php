<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800">Order #{{ $order->id }}</h2>
            <a href="{{ route('manage.orders.index') }}" class="px-3 py-1 bg-gray-200 rounded">Back</a>
        </div>
    </x-slot>

    <div class="py-6 max-w-5xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-4">
        @if (session('success'))
            <div class="lg:col-span-3 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="lg:col-span-3 p-3 bg-red-100 text-red-800 rounded">{{ session('error') }}</div>
        @endif

        <div class="lg:col-span-2 bg-white rounded shadow">
            <div class="p-4 border-b font-semibold">Items</div>
            <div class="p-4 overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-3 py-2 text-left">Product</th>
                        <th class="px-3 py-2 text-center">Qty</th>
                        <th class="px-3 py-2 text-right">Unit</th>
                        <th class="px-3 py-2 text-right">Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($order->items as $it)
                        <tr class="border-t">
                            <td class="px-3 py-2">
                                {{ $it->product->name ?? '—' }}
                                <div class="text-xs text-gray-500">SKU: {{ $it->product->sku ?? '-' }}</div>
                            </td>
                            <td class="px-3 py-2 text-center">{{ $it->qty }}</td>
                            <td class="px-3 py-2 text-right">{{ number_format($it->unit_price,2) }}</td>
                            <td class="px-3 py-2 text-right">{{ number_format($it->subtotal,2) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot class="border-t bg-gray-50">
                        <tr>
                            <td class="px-3 py-2 font-semibold" colspan="3">Total</td>
                            <td class="px-3 py-2 text-right font-semibold">{{ number_format($order->total,2) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div class="bg-white rounded shadow">
            <div class="p-4 border-b font-semibold">Order Info</div>
            <div class="p-4 space-y-3 text-sm">
                <div><span class="text-gray-500">Customer:</span> {{ $order->user->name ?? '-' }}</div>
                <div><span class="text-gray-500">Email:</span> {{ $order->user->email ?? '-' }}</div>
                <div><span class="text-gray-500">Created:</span> {{ $order->created_at->format('Y-m-d H:i') }}</div>
                <div><span class="text-gray-500">Payment:</span> {{ $order->payment_method ?? '-' }}</div>

                <div>
                    <span class="text-gray-500">Status:</span>
                    <span class="px-2 py-1 rounded text-xs
                        @switch($order->status)
                            @case('pending')   bg-yellow-100 text-yellow-800 @break
                            @case('paid')      bg-blue-100 text-blue-800 @break
                            @case('shipped')   bg-green-100 text-green-800 @break
                            @case('cancelled') bg-gray-200 text-gray-700 @break
                        @endswitch">
                        {{ $order->status }}
                    </span>
                </div>

                {{-- Update status (staff/admin ทำได้) --}}
                <form method="POST" action="{{ route('manage.orders.update', $order) }}" class="pt-2 border-t mt-2">
                    @csrf
                    @method('PUT')
                    <label class="block text-sm font-medium text-gray-700">Update Status</label>
                    <select name="status" class="mt-1 w-full border rounded p-2">
                        @php $status = old('status', $order->status); @endphp
                        <option value="pending"   {{ $status==='pending' ? 'selected' : '' }}>pending</option>
                        <option value="paid"      {{ $status==='paid' ? 'selected' : '' }}>paid</option>
                        <option value="shipped"   {{ $status==='shipped' ? 'selected' : '' }}>shipped</option>
                        <option value="cancelled" {{ $status==='cancelled' ? 'selected' : '' }}>cancelled</option>
                    </select>
                    @error('status') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror

                    <div class="mt-3">
                        <button class="px-4 py-2 bg-indigo-600 text-white rounded w-full">Save</button>
                    </div>
                </form>

                {{-- Delete: เฉพาะ Admin เท่านั้น --}}
                @if(auth()->user()->isAdmin())
                    <form method="POST" action="{{ route('manage.orders.destroy', $order) }}"
                          onsubmit="return confirm('Delete this order?')" class="pt-3 border-t">
                        @csrf
                        @method('DELETE')
                        <button class="px-4 py-2 bg-red-600 text-white rounded w-full">Delete Order</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
