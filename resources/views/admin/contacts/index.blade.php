<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl">Contact channels</h2>
            <a href="{{ route('manage.contacts.create') }}"
               class="px-3 py-2 bg-blue-600 text-white rounded">Create</a>
        </div>
    </x-slot>

    @if (session('success'))
        <div class="max-w-6xl mx-auto mt-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="max-w-6xl mx-auto mt-4 bg-white p-4 rounded shadow">
        <table class="w-full text-left">
            <thead>
            <tr class="border-b">
                <th class="py-2">Group</th>
                <th>Type</th>
                <th>Label</th>
                <th>Value</th>
                <th>Status</th>
                <th>Updated</th>
                <th class="text-right">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($channels as $c)
                <tr class="border-b">
                    <td class="py-2">{{ $c->group }}</td>
                    <td class="text-gray-600">{{ $c->type }}</td>
                    <td class="font-medium">{{ $c->label }}</td>
                    <td class="text-gray-600 truncate max-w-[22rem]">
                        {{ $c->value }} @if($c->url) <span class="text-gray-400">({{ $c->url }})</span>@endif
                    </td>
                    <td>
                        @if($c->is_active)
                            <span class="text-green-700">Active</span>
                        @else
                            <span class="text-gray-500">Hidden</span>
                        @endif
                    </td>
                    <td class="text-gray-600 whitespace-nowrap">{{ $c->updated_at->diffForHumans() }}</td>
                    <td class="text-right whitespace-nowrap">
                        <a href="{{ route('manage.contacts.edit', $c) }}" class="text-blue-600 mr-3">Edit</a>
                        <form action="{{ route('manage.contacts.destroy', $c) }}" method="POST" class="inline"
                              onsubmit="return confirm('Delete this channel?')">
                            @csrf @method('DELETE')
                            <button class="text-red-600">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="py-6 text-center text-gray-500">No contact channels.</td></tr>
            @endforelse
            </tbody>
        </table>

        <div class="mt-4">{{ $channels->links() }}</div>
    </div>
</x-app-layout>
