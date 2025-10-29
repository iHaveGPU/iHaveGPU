<x-app-layout>
  <x-slot name="header"><h2 class="font-semibold text-xl">Create Product</h2></x-slot>
  <div class="max-w-4xl mx-auto mt-6 bg-white p-6 rounded shadow">
    <form method="POST" action="{{ route('manage.products.store') }}" enctype="multipart/form-data">
      @include('admin.products._form', ['submitLabel' => 'Create'])
    </form>
  </div>
</x-app-layout>
