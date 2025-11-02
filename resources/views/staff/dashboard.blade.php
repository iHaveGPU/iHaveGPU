<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800">Staff Dashboard</h2>
  </x-slot>

  <div class="py-6 max-w-7xl mx-auto">
    @if (session('success'))
      <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
    @endif
    @if (session('error'))
      <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">{{ session('error') }}</div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      @if (Route::has('manage.products.index'))
        <a href="{{ route('manage.products.index') }}"
           class="block p-5 bg-white rounded-2xl shadow hover:shadow-lg transition">
          <div class="text-lg font-semibold">Products</div>
          <p class="text-sm text-gray-600 mt-1">Manage Product</p>
        </a>
      @endif

      @if (Route::has('manage.categories.index'))
        <a href="{{ route('manage.categories.index') }}"
           class="block p-5 bg-white rounded-2xl shadow hover:shadow-lg transition">
          <div class="text-lg font-semibold">Categories</div>
          <p class="text-sm text-gray-600 mt-1">Manage Category</p>
        </a>
      @endif

      @if (Route::has('manage.articles.index'))
        <a href="{{ route('manage.articles.index') }}"
           class="block p-5 bg-white rounded-2xl shadow hover:shadow-lg transition">
          <div class="text-lg font-semibold">Articles</div>
          <p class="text-sm text-gray-600 mt-1">Manage Articles</p>
        </a>
      @endif

      @if (Route::has('manage.sets.index'))
        <a href="{{ route('manage.sets.index') }}"
           class="block p-5 bg-white rounded-2xl shadow hover:shadow-lg transition">
          <div class="text-lg font-semibold">Computer Sets</div>
          <p class="text-sm text-gray-600 mt-1">Manage Sets</p>
        </a>
      @endif

      {{-- แสดง Brands ให้ staff จัดการได้ด้วย --}}
      @if (Route::has('manage.brands.index'))
        <a href="{{ route('manage.brands.index') }}"
           class="block p-5 bg-white rounded-2xl shadow hover:shadow-lg transition">
          <div class="text-lg font-semibold">Brands</div>
          <p class="text-sm text-gray-600 mt-1">Manage Brands</p>
        </a>
      @endif

      @if (Route::has('manage.orders.index'))
        <a href="{{ route('manage.orders.index') }}"
           class="block p-5 bg-white rounded-2xl shadow hover:shadow-lg transition">
          <div class="text-lg font-semibold">Orders</div>
          <p class="text-sm text-gray-600 mt-1">View & Update Orders</p>
        </a>
      @endif
    </div>
  </div>
</x-app-layout>
