@php
    /** @var \App\Models\User|null $user */
    $isEdit   = isset($user);
    $roleNow  = old('role', $user->role ?? 'customer');
    $roles    = ['admin' => 'Admin', 'staff' => 'Staff', 'customer' => 'Customer'];
    $selfEdit = $isEdit && auth()->id() === ($user->id ?? null);
@endphp

<div class="grid md:grid-cols-2 gap-4">
    {{-- Name --}}
    <div>
        <x-input-label for="name" value="Name"/>
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                      :value="old('name', $user->name ?? '')" required autofocus/>
        <x-input-error :messages="$errors->get('name')" class="mt-2"/>
    </div>

    {{-- Email --}}
    <div>
        <x-input-label for="email" value="Email"/>
        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                      :value="old('email', request('email', $user->email ?? ''))" required autocomplete="username"/>
        <x-input-error :messages="$errors->get('email')" class="mt-2"/>
    </div>

    {{-- Role (ถ้าแก้ตัวเอง จะล็อกไม่ให้เปลี่ยน role เพื่อลด human error) --}}
    <div>
        <x-input-label for="role" value="Role"/>
        <select id="role" name="role"
                class="mt-1 block w-full rounded border-gray-300 disabled:opacity-50"
                {{ $selfEdit ? 'disabled' : '' }}>
            @foreach($roles as $val => $label)
                <option value="{{ $val }}" @selected($roleNow === $val)>{{ $label }}</option>
            @endforeach
        </select>
        @if($selfEdit)
            <input type="hidden" name="role" value="{{ $roleNow }}">
            <p class="text-xs text-gray-500 mt-1">You can’t change your own role here.</p>
        @endif
        <x-input-error :messages="$errors->get('role')" class="mt-2"/>
    </div>

    {{-- Password --}}
    <div>
        <x-input-label for="password" :value="$isEdit ? 'Password (leave blank to keep)' : 'Password'"/>
        <x-text-input id="password" name="password" type="password" class="mt-1 block w-full"
                      @unless($isEdit) required @endunless />
        <x-input-error :messages="$errors->get('password')" class="mt-2"/>
    </div>

    {{-- Confirm Password --}}
    <div class="md:col-span-2">
        <x-input-label for="password_confirmation" value="Confirm Password"/>
        <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full"/>
        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
    </div>
</div>
