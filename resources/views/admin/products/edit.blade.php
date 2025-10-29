<x-app-layout>
  <x-slot name="header"><h2 class="font-semibold text-xl">Edit Product #{{ $product->id }}</h2></x-slot>
  <div class="p-6 bg-white shadow sm:rounded">
    <form method="POST" action="{{ route('manage.products.update', $product) }}" enctype="multipart/form-data">
      @csrf @method('PUT')
      @include('admin.products._form', ['product' => $product, 'categories' => $categories, 'brands' => $brands]) {{-- ✅ --}}
      <div class="mt-4">
        <a href="{{ route('manage.products.index') }}" class="mr-3 text-gray-600">Back</a>
        <x-primary-button>Save</x-primary-button>
      </div>
    </form>
  </div>
</x-app-layout>
