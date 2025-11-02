<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    {{-- สำหรับ resend verification --}}
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    {{-- ฟอร์มหลัก: รวมทุกฟิลด์ไว้ในฟอร์มเดียว --}}
    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        {{-- Basic --}}
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}
                        <button form="send-verification"
                                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        {{-- Contact & Shipping (Prefill ใช้ตอน Checkout) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <x-input-label for="phone" :value="__('Phone')" />
                <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full"
                    :value="old('phone', $user->phone)" autocomplete="tel" />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="line_id" :value="__('Line ID')" />
                <x-text-input id="line_id" name="line_id" type="text" class="mt-1 block w-full"
                    :value="old('line_id', $user->line_id)" />
                <x-input-error :messages="$errors->get('line_id')" class="mt-2" />
            </div>

            <div class="md:col-span-2">
                <x-input-label for="address1" :value="__('Address (line 1)')" />
                <x-text-input id="address1" name="address1" type="text" class="mt-1 block w-full"
                    :value="old('address1', $user->address1)" autocomplete="address-line1" />
                <x-input-error :messages="$errors->get('address1')" class="mt-2" />
            </div>

            <div class="md:col-span-2">
                <x-input-label for="address2" :value="__('Address (line 2)')" />
                <x-text-input id="address2" name="address2" type="text" class="mt-1 block w-full"
                    :value="old('address2', $user->address2)" autocomplete="address-line2" />
                <x-input-error :messages="$errors->get('address2')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="district" :value="__('District / Subdistrict')" />
                <x-text-input id="district" name="district" type="text" class="mt-1 block w-full"
                    :value="old('district', $user->district)" autocomplete="address-level3" />
                <x-input-error :messages="$errors->get('district')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="province" :value="__('Province')" />
                <x-text-input id="province" name="province" type="text" class="mt-1 block w-full"
                    :value="old('province', $user->province)" autocomplete="address-level1" />
                <x-input-error :messages="$errors->get('province')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="postcode" :value="__('Postcode')" />
                <x-text-input id="postcode" name="postcode" type="text" class="mt-1 block w-full"
                    :value="old('postcode', $user->postcode)" autocomplete="postal-code" />
                <x-input-error :messages="$errors->get('postcode')" class="mt-2" />
            </div>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition
                   x-init="setTimeout(() => show = false, 2000)"
                   class="text-sm text-gray-600">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>