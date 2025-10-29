<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center justify-between">
      <h2 class="font-semibold text-xl">Manage Brands</h2>
      <a href="{{ route('manage.brands.create') }}" class="px-3 py-2 bg-indigo-600 text-white rounded">+ New Brand</a>
    </div>
  </x-slot>

  <div class="p-6 bg-white shadow sm:rounded">
    @if(session('success')) <div class="mb-3 p-2 bg-green-100 text-green-800 rounded">{{ session('success') }}</div> @endif
    <table class="min-w-full text-sm">
      <thead class="border-b font-medium">
        <tr><th class="text-left py-2">ID</th><th class="text-left">Name</th><th class="text-left">Slug</th><th class="text-right">Actions</th></tr>
      </thead>
      <tbody>
        @forelse($brands as $b)
          <tr class="border-b">
            <td class="py-2">{{ $b->id }}</td>
            <td>{{ $b->name }}</td>
            <td class="text-gray-500">{{ $b->slug }}</td>
            <td class="text-right">
              <a href="{{ route('manage.brands.edit',$b) }}" class="text-blue-600 mr-3">Edit</a>
              <form action="{{ route('manage.brands.destroy',$b) }}" method="POST" class="inline" onsubmit="return confirm('Delete brand?')">
                @csrf @method('DELETE')
                <button class="text-red-600">Delete</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="4" class="text-center p-6 text-gray-500">No brands</td></tr>
        @endforelse
      </tbody>
    </table>
    <div class="mt-4">{{ $brands->links() }}</div>
  </div>
</x-app-layout>
