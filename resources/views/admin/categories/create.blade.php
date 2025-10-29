<x-app-layout>
  <x-slot name="header"><h2 class="font-semibold text-xl">New Category</h2></x-slot>
  <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <form method="POST" action="{{ route('manage.categories.store') }}">
      @include('admin.categories._form', ['category' => new \App\Models\Category(),'submitLabel'=>'Create'])
    </form>
  </div>
</x-app-layout>
