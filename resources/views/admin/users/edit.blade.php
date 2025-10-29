<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Edit User #{{ $user->id }}</h2>
    </x-slot>

    <div class="p-6 max-w-xl mx-auto">
        <div class="bg-white p-6 rounded shadow">
            <div class="mb-4">
                <div class="text-sm text-gray-500">Name</div>
                <div class="font-medium">{{ $user->name }}</div>
            </div>
            <div class="mb-6">
                <div class="text-sm text-gray-500">Email</div>
                <div class="font-medium">{{ $user->email }}</div>
            </div>

            <form method="POST" action="{{ route('manage.users.update', $user) }}">
                @csrf @method('PUT')

                <div>
                    <x-input-label for="role" value="Role"/>
                    <select id="role" name="role" class="mt-1 block w-full rounded border-gray-300">
                        @foreach($roles as $val => $label)
                            <option value="{{ $val }}" @selected(old('role', $user->role) === $val)>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('role')" class="mt-2"/>
                </div>

                <div class="mt-6 flex gap-3">
                    <x-primary-button>Save</x-primary-button>
                    <a href="{{ route('manage.users.index') }}" class="px-4 py-2 bg-gray-200 rounded">Back</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
