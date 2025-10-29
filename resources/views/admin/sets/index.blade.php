<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center justify-between">
      <h2 class="font-semibold text-xl">Manage Computer Sets</h2>
      <a href="{{ route('manage.sets.create') }}" class="px-3 py-2 bg-blue-600 text-white rounded">New Set</a>
    </div>
  </x-slot>

  @if(session('success'))
    <div class="max-w-6xl mx-auto mt-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
  @endif

  <div class="max-w-6xl mx-auto mt-6 bg-white rounded shadow">
    <table class="w-full text-left">
      <thead>
        <tr class="border-b">
          <th class="p-3">Name</th>
          <th class="p-3">Slug</th>
          <th class="p-3">Items</th>
          <th class="p-3 w-40">Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($sets as $set)
          <tr class="border-b">
            <td class="p-3">{{ $set->name }}</td>
            <td class="p-3 text-gray-500">{{ $set->slug }}</td>
            <td class="p-3">{{ $set->products_count }}</td>
            <td class="p-3 space-x-2">
              <a href="{{ route('manage.sets.edit', $set) }}" class="px-2 py-1 bg-yellow-500 text-white rounded">Edit</a>
              <form method="POST" action="{{ route('manage.sets.destroy', $set) }}" class="inline" onsubmit="return confirm('Delete this set?')">
                @csrf @method('DELETE')
                <button class="px-2 py-1 bg-red-600 text-white rounded">Delete</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td class="p-3 text-gray-500" colspan="4">No sets.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="max-w-6xl mx-auto mt-4">
    {{ $sets->links() }}
  </div>
</x-app-layout>
