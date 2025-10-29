<x-app-layout>
  <x-slot name="header"><h2 class="font-semibold text-xl">Manage Categories</h2></x-slot>

  <div class="max-w-5xl mx-auto bg-white p-6 rounded shadow">
    <div class="flex justify-end mb-4">
      <a href="{{ route('manage.categories.create') }}" class="px-3 py-2 bg-blue-600 text-white rounded">+ New Category</a>
    </div>

    <table class="w-full text-sm">
      <thead class="border-b">
        <tr>
          <th class="text-left py-2">#</th>
          <th class="text-left">Name</th>
          <th class="text-left">Slug</th>
          <th class="text-left">Sort</th>
          <th class="text-left">Active</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @forelse($cats as $c)
          <tr class="border-b">
            <td class="py-2">{{ $c->id }}</td>
            <td>{{ $c->name }}</td>
            <td class="text-gray-500">{{ $c->slug }}</td>
            <td>{{ $c->sort_order }}</td>
            <td>{{ $c->is_active ? 'Yes' : 'No' }}</td>
            <td class="text-right">
              <a href="{{ route('manage.categories.edit',$c) }}" class="text-blue-600 mr-2">Edit</a>
              <form action="{{ route('manage.categories.destroy',$c) }}" method="POST" class="inline"
                    onsubmit="return confirm('Delete this category?')">
                @csrf @method('DELETE')
                <button class="text-red-600">Delete</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="6" class="py-6 text-center text-gray-500">No categories.</td></tr>
        @endforelse
      </tbody>
    </table>

    <div class="mt-4">{{ $cats->links() }}</div>
  </div>
</x-app-layout>
