<x-app-layout>
  <x-slot name="header"><h2 class="font-semibold text-xl">Edit Brand #{{ $brand->id }}</h2></x-slot>
  <div class="p-6 bg-white shadow sm:rounded">
    <form method="POST" action="{{ route('manage.brands.update', $brand) }}" enctype="multipart/form-data">
      @csrf @method('PUT')
      @include('admin.brands._form', ['brand' => $brand])
      <div class="mt-4">
        <x-primary-button>Save</x-primary-button>
        <a href="{{ route('manage.brands.index') }}" class="ml-3 text-gray-600">Back</a>
      </div>
    </form>
  </div>
</x-app-layout>
