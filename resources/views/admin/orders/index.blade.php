<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800">Orders</h2>
            <form method="GET" class="flex items-center gap-2">
                @php $status = request('status'); @endphp
                <select name="status" class="border rounded p-2">
                    <option value="">-- All --</option>
                    <option value="pending"   {{ $status==='pending' ? 'selected' : '' }}>pending</option>
                    <option value="paid"      {{ $status==='paid' ? 'selected' : '' }}>paid</option>
                    <option value="shipped"   {{ $status==='shipped' ? 'selected' : '' }}>shipped</option>
                    <option value="cancelled" {{ $status==='cancelled' ? 'selected' : '' }}>cancelled</option>
                </select>
                <button class="px-3 py-2 bg-gray-100 rounded">Filter</button>
            </form>
        </div>
    </x-slot>

    <div class="py-6 max-w-6xl mx-auto">
        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white shadow rounded overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left">ID</th>
                    <th class="px-4 py-2 text-left">Customer</th>
                    <th class="px-4 py-2 text-right">Total</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-4 py-2 text-left">Created</th>
                    <th class="px-4 py-2"></th>
                </tr>
                </thead>
                <tbody>
                @forelse ($orders as $o)
                    <tr class="border-t">
                        <td class="px-4 py-2">#{{ $o->id }}</td>
                        <td class="px-4 py-2">
                            {{ $o->user->name ?? '-' }}<br>
                            <span class="text-xs text-gray-500">{{ $o->user->email ?? '' }}</span>
                        </td>
                        <td class="px-4 py-2 text-right">{{ number_format($o->total, 2) }}</td>
                        <td class="px-4 py-2">
                            <span class="px-2 py-1 rounded text-xs
                                @switch($o->status)
                                    @case('pending')   bg-yellow-100 text-yellow-800 @break
                                    @case('paid')      bg-blue-100 text-blue-800 @break
                                    @case('shipped')   bg-green-100 text-green-800 @break
                                    @case('cancelled') bg-gray-200 text-gray-700 @break
                                @endswitch">
                                {{ $o->status }}
                            </span>
                        </td>
                        <td class="px-4 py-2 text-sm text-gray-600">{{ $o->created_at->format('Y-m-d H:i') }}</td>
                        <td class="px-4 py-2 text-right space-x-2">
                            <a href="{{ route('manage.orders.show', $o) }}"
                               class="px-3 py-1 bg-indigo-600 text-white rounded">View</a>

                            {{-- ลบ: เฉพาะ Admin --}}
                            @if(auth()->user()->isAdmin())
                                <form action="{{ route('manage.orders.destroy', $o) }}" method="POST" class="inline"
                                      onsubmit="return confirm('Delete this order?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="px-3 py-1 bg-red-600 text-white rounded">Delete</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td class="px-4 py-6 text-center text-gray-500" colspan="6">No orders</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $orders->withQueryString()->links() }}
        </div>
    </div>
</x-app-layout>
