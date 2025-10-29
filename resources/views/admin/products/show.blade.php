<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800">Product #{{ $product->id }}</h2>
            <div class="space-x-2">
                <a href="{{ route('manage.products.edit', $product) }}" class="px-3 py-1 bg-yellow-500 text-white rounded">Edit</a>
                <a href="{{ route('manage.products.index') }}" class="px-3 py-1 bg-gray-200 rounded">Back</a>
            </div>
        </div>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto bg-white p-6 rounded shadow">
        <div class="text-2xl font-bold mb-2">{{ $product->name }}</div>
        <div class="text-gray-600">SKU: {{ $product->sku }}</div>
        <div class="text-xl mt-2 mb-4">Price: {{ number_format($product->price,2) }}</div>
        <div>Status:
            <span class="px-2 py-1 rounded text-xs
                {{ $product->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                {{ ucfirst($product->status) }}
            </span>
        </div>
        <div class="mt-2">Stock: {{ $product->stock->qty ?? 0 }}</div>
    </div>
</x-app-layout>
