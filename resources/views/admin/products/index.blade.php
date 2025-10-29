<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800">Manage Products</h2>
            <a href="{{ route('manage.products.create') }}"
               class="px-4 py-2 bg-blue-600 text-white rounded">+ New Product</a>
        </div>
    </x-slot>

    <div class="py-6 max-w-6xl mx-auto">
        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow rounded overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left">ID</th>
                    <th class="px-4 py-2 text-left">Name</th>
                    <th class="px-4 py-2 text-left">SKU</th>
                    <th class="px-4 py-2 text-right">Price</th>
                    <th class="px-4 py-2 text-center">Stock</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-4 py-2"></th>
                </tr>
                </thead>
                <tbody>
                @forelse ($products as $p)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $p->id }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('manage.products.show', $p) }}" class="text-blue-700 hover:underline">
                                {{ $p->name }}
                            </a>
                        </td>
                        <td class="px-4 py-2">{{ $p->sku }}</td>
                        <td class="px-4 py-2 text-right">{{ number_format($p->price, 2) }}</td>
                        <td class="px-4 py-2 text-center">{{ $p->stock->qty ?? 0 }}</td>
                        <td class="px-4 py-2">
                            <span class="px-2 py-1 rounded text-xs
                                {{ $p->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                                {{ ucfirst($p->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-2 text-right">
                            <a href="{{ route('manage.products.edit', $p) }}"
                               class="px-3 py-1 bg-yellow-500 text-white rounded">Edit</a>

                            <form action="{{ route('manage.products.destroy', $p) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Delete this product?')">
                                @csrf
                                @method('DELETE')
                                <button class="px-3 py-1 bg-red-600 text-white rounded">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td class="px-4 py-6 text-center text-gray-500" colspan="7">No products</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $products->links() }}
        </div>
    </div>
</x-app-layout>
