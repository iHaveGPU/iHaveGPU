@php($isEdit = isset($brand) && $brand->exists)
<div class="grid md:grid-cols-2 gap-4">

    <div>
        <x-input-label for="name" value="Name"/>
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                      :value="old('name', $brand->name ?? '')" required/>
        <x-input-error :messages="$errors->get('name')" class="mt-2"/>
    </div>

    <div>
        <x-input-label for="slug" value="Slug"/>
        <x-text-input id="slug" name="slug" type="text" class="mt-1 block w-full"
                      :value="old('slug', $brand->slug ?? '')" placeholder="(auto from name if empty)"/>
        <x-input-error :messages="$errors->get('slug')" class="mt-2"/>
    </div>

    <div class="md:col-span-2">
        <x-input-label for="logo" value="Logo (PNG/JPG up to 2MB)"/>
        <input id="logo" name="logo" type="file" accept="image/*"
               class="mt-1 block w-full border rounded p-2">
        <x-input-error :messages="$errors->get('logo')" class="mt-2"/>

        @if($isEdit && $brand->logo_url)
            <div class="mt-3">
                <div class="text-sm text-gray-600 mb-1">Current Logo:</div>
                <img src="{{ $brand->logo_url }}" alt="Logo" class="h-14 object-contain bg-white p-2 rounded border">
            </div>
        @endif
    </div>

</div>
