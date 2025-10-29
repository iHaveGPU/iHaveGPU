<x-app-layout>
  <x-slot name="header"><h2 class="font-semibold text-xl">Create Brand</h2></x-slot>
  <div class="p-6 bg-white shadow sm:rounded">
    <form method="POST" action="{{ route('manage.brands.store') }}" enctype="multipart/form-data">
      @csrf
      @include('admin.brands._form', ['brand' => new \App\Models\Brand()])
      <div class="mt-4">
        <x-primary-button>Create</x-primary-button>
        <a href="{{ route('manage.brands.index') }}" class="ml-3 text-gray-600">Cancel</a>
      </div>
    </form>
  </div>
</x-app-layout>
