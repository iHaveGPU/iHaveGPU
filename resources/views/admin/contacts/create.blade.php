<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Create contact channel</h2>
    </x-slot>

    <div class="max-w-3xl mx-auto mt-4 bg-white p-6 rounded shadow">
        <form method="POST" action="{{ route('manage.contacts.store') }}" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm mb-1">Group</label>
                    <input name="group" value="{{ old('group','general') }}" class="w-full border rounded p-2">
                </div>
                <div>
                    <label class="block text-sm mb-1">Type</label>
                    <select name="type" class="w-full border rounded p-2">
                        @foreach(['text','phone','email','link','address','line'] as $t)
                            <option value="{{ $t }}" @selected(old('type')===$t)>{{ ucfirst($t) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm mb-1">Label</label>
                    <input name="label" value="{{ old('label') }}" class="w-full border rounded p-2" required>
                </div>
                <div>
                    <label class="block text-sm mb-1">Value</label>
                    <input name="value" value="{{ old('value') }}" class="w-full border rounded p-2">
                </div>
                <div>
                    <label class="block text-sm mb-1">URL</label>
                    <input name="url" value="{{ old('url') }}" class="w-full border rounded p-2" placeholder="tel:, mailto:, https://">
                </div>
                <div>
                    <label class="block text-sm mb-1">Sort order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order',0) }}" class="w-full border rounded p-2">
                </div>
                <div class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" class="mr-2" checked>
                    <span>Active</span>
                </div>
            </div>

            <div class="pt-4">
                <button class="px-4 py-2 bg-blue-600 text-white rounded">Save</button>
                <a href="{{ route('manage.contacts.index') }}" class="ml-3 text-gray-600">Cancel</a>
            </div>
        </form>
    </div>
</x-app-layout>
