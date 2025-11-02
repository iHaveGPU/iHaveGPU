<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800">Admin Dashboard</h2>
  </x-slot>

  <div class="py-6 max-w-7xl mx-auto">
    @if (session('success'))
      <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
    @endif
    @if (session('error'))
      <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">{{ session('error') }}</div>
    @endif

    @php($canManage = auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isStaff()))
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

      {{-- ===== Staff + Admin 共用 ===== --}}
      @if($canManage && Route::has('manage.products.index'))
        <a href="{{ route('manage.products.index') }}"
           class="block p-5 bg-white rounded-2xl shadow hover:shadow-lg transition">
          <div class="text-lg font-semibold">Products</div>
          <p class="text-sm text-gray-600 mt-1">Manage products & attributes</p>
        </a>
      @endif

      @if($canManage && Route::has('manage.categories.index'))
        <a href="{{ route('manage.categories.index') }}"
           class="block p-5 bg-white rounded-2xl shadow hover:shadow-lg transition">
          <div class="text-lg font-semibold">Categories</div>
          <p class="text-sm text-gray-600 mt-1">Manage product categories</p>
        </a>
      @endif>

      @if($canManage && Route::has('manage.articles.index'))
        <a href="{{ route('manage.articles.index') }}"
           class="block p-5 bg-white rounded-2xl shadow hover:shadow-lg transition">
          <div class="text-lg font-semibold">Articles</div>
          <p class="text-sm text-gray-600 mt-1">Manage articles</p>
        </a>
      @endif

      @if($canManage && Route::has('manage.sets.index'))
        <a href="{{ route('manage.sets.index') }}"
           class="block p-5 bg-white rounded-2xl shadow hover:shadow-lg transition">
          <div class="text-lg font-semibold">Computer Sets</div>
          <p class="text-sm text-gray-600 mt-1">Manage bundle / computer sets</p>
        </a>
      @endif

      @if($canManage && Route::has('manage.orders.index'))
        <a href="{{ route('manage.orders.index') }}"
           class="block p-5 bg-white rounded-2xl shadow hover:shadow-lg transition">
          <div class="text-lg font-semibold">Orders</div>
          <p class="text-sm text-gray-600 mt-1">View & update orders</p>
        </a>
      @endif

      {{-- ===== เพิ่ม Brands ให้ staff+admin ใช้ร่วมกันด้วย ===== --}}
      @if($canManage && Route::has('manage.brands.index'))
        <a href="{{ route('manage.brands.index') }}"
           class="block p-5 bg-white rounded-2xl shadow hover:shadow-lg transition">
          <div class="text-lg font-semibold">Brands</div>
          <p class="text-sm text-gray-600 mt-1">Create / edit brands</p>
        </a>
      @endif

      {{-- ===== Admin only: Users / Contacts ===== --}}
      @if(auth()->check() && auth()->user()->isAdmin())
        @if (Route::has('manage.users.index'))
          <a href="{{ route('manage.users.index') }}"
             class="block p-5 bg-white rounded-2xl shadow hover:shadow-lg transition">
            <div class="text-lg font-semibold">Users</div>
            <p class="text-sm text-gray-600 mt-1">Change role / delete user</p>
          </a>
        @endif

        @if (Route::has('manage.contacts.index'))
          <a href="{{ route('manage.contacts.index') }}"
             class="block p-5 bg-white rounded-2xl shadow hover:shadow-lg transition">
            <div class="text-lg font-semibold">Contact Channels</div>
            <p class="text-sm text-gray-600 mt-1">Manage contact entries</p>
          </a>
        @endif
      @endif
    </div>
  </div>
</x-app-layout>
