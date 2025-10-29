<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Manage Users</h2>
    </x-slot>

    <div class="p-6 max-w-6xl mx-auto">
        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">{{ session('error') }}</div>
        @endif

        <div class="bg-white shadow rounded overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left">ID</th>
                        <th class="px-4 py-2 text-left">Name</th>
                        <th class="px-4 py-2 text-left">Email</th>
                        <th class="px-4 py-2 text-left">Role</th>
                        <th class="px-4 py-2 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($users as $u)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $u->id }}</td>
                        <td class="px-4 py-2">{{ $u->name }}</td>
                        <td class="px-4 py-2">{{ $u->email }}</td>
                        <td class="px-4 py-2 uppercase">{{ $u->role }}</td>
                        <td class="px-4 py-2 text-right">
                            @if (auth()->id() !== $u->id)
                                <a href="{{ route('manage.users.edit', $u) }}"
                                   class="px-3 py-1 bg-yellow-500 text-white rounded">Edit</a>
                                <form action="{{ route('manage.users.destroy', $u) }}"
                                      method="POST" class="inline"
                                      onsubmit="return confirm('Delete this user?')">
                                    @csrf @method('DELETE')
                                    <button class="px-3 py-1 bg-red-600 text-white rounded">Delete</button>
                                </form>
                            @else
                                <span class="text-gray-400">You</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="px-4 py-6 text-center text-gray-500" colspan="5">No users</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
</x-app-layout>
