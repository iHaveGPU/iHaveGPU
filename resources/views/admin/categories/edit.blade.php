<x-app-layout>
  <x-slot name="header"><h2 class="font-semibold text-xl">Edit Category</h2></x-slot>
  <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <form method="POST" action="{{ route('manage.categories.update',$category) }}">
      @method('PUT')
      @include('admin.categories._form', ['category' => $category, 'submitLabel'=>'Update'])
    </form>
  </div>
</x-app-layout>
