<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            {{ isset($category) ? 'Products · ' . $category->name : 'Products' }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-6 grid grid-cols-1 md:grid-cols-12 gap-6">
        {{-- Sidebar categories --}}
        <aside class="md:col-span-3">
            @isset($categories)
                <div class="bg-white rounded shadow p-3">
                    <div class="font-semibold mb-2">หมวดหมู่</div>
                    <ul class="space-y-1">
                        @foreach($categories as $c)
                            <li>
                                <a href="{{ route('categories.show', $c->slug) }}"
                                   class="block px-2 py-1 rounded
                                    {{ isset($category) && $category->id === $c->id
                                        ? 'bg-blue-50 text-blue-700 font-medium'
                                        : 'hover:bg-gray-50' }}">
                                    {{ $c->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endisset
        </aside>

        {{-- Main --}}
        <main class="md:col-span-9">
            {{-- Search / filter bar --}}
            <form method="GET" action="{{ route('products.index') }}"
                  class="mb-4 bg-white rounded shadow p-3 grid grid-cols-1 md:grid-cols-12 gap-3">
                <div class="md:col-span-6">
                    <input type="text" name="q" value="{{ request('q') }}"
                           placeholder="ค้นหาชื่อสินค้า หรือ SKU..."
                           class="w-full border rounded p-2">
                </div>

                <div class="md:col-span-2">
                    <input type="number" name="min" value="{{ request('min') }}"
                           step="0.01" min="0" placeholder="ราคาต่ำสุด"
                           class="w-full border rounded p-2">
                </div>
                <div class="md:col-span-2">
                    <input type="number" name="max" value="{{ request('max') }}"
                           step="0.01" min="0" placeholder="ราคาสูงสุด"
                           class="w-full border rounded p-2">
                </div>

                {{-- preserve category ถ้ากำลังดูจากหน้า /categories/{slug} --}}
                @if(isset($category))
                    <input type="hidden" name="category" value="{{ $category->slug }}">
                @endif

                <div class="md:col-span-2 flex gap-2">
                    <button class="px-4 py-2 bg-gray-800 text-white rounded w-full">ค้นหา</button>
                    <a href="{{ isset($category) ? route('categories.show',$category->slug) : route('products.index') }}"
                       class="px-4 py-2 bg-gray-200 rounded text-center w-full">ล้าง</a>
                </div>
            </form>

            {{-- Products grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @forelse ($products as $p)
                    <a href="{{ route('products.show', $p) }}"
                      rel="noopener"
                       class="p-4 bg-white rounded shadow hover:shadow-md block">
                        <img src="{{ $p->cover_url }}" alt="{{ $p->name }}"
                             class="w-full h-40 object-cover rounded mb-3">
                        <div class="text-lg font-semibold line-clamp-2">{{ $p->name }}</div>

                        {{-- แสดงแบรนด์ (ถ้ามี) --}}
                        @if($p->brand)
                            <div class="text-xs text-gray-500 mt-1">{{ $p->brand->name }}</div>
                        @endif

                        {{-- แสดงหมวดหมู่ (ถ้ามี) --}}
                        @if($p->category)
                            <div class="text-xs text-gray-500">{{ $p->category->name }}</div>
                        @endif

                        {{-- SKU (ถ้ามี) --}}
                        @if($p->sku)
                            <div class="text-gray-500 text-sm mt-1">SKU: {{ $p->sku }}</div>
                        @endif

                        <div class="text-gray-900 font-semibold mt-2">
                            ฿{{ number_format($p->price, 2) }}
                        </div>
                    </a>
                @empty
                    <p class="col-span-full text-center text-gray-500">No products.</p>
                @endforelse
            </div>

            <div class="mt-4">{{ $products->links() }}</div>
        </main>
    </div>
</x-app-layout>
