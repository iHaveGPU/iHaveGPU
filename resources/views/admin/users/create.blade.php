<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800">Create User</h2>
            <a href="{{ route('manage.users.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Back to list</a>
        </div>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto">
        <div class="bg-white p-6 rounded shadow">
            <form method="POST" action="{{ route('manage.users.store') }}">
                @csrf
                @include('admin.users._form')

                <div class="mt-6 flex gap-3">
                    <a href="{{ route('manage.users.index') }}" class="px-4 py-2 bg-gray-200 rounded">Cancel</a>
                    <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Create</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
