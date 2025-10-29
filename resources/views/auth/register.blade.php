<x-guest-layout>
  <div class="min-h-screen grid grid-cols-1 lg:grid-cols-2">
    {{-- LEFT: form --}}
    <div class="flex flex-col justify-center px-6 sm:px-10 lg:px-16 py-10">
      {{-- Logo --}}
      <div class="mb-8">
        <img src="{{ asset('images/logo/logo.png') }}" alt="iHaveGPU" class="h-10">
      </div>

      <h1 class="text-xl font-semibold text-gray-900">
        Create your account
      </h1>
      <p class="mt-1 text-sm text-gray-500">Join iHaveGPU to get started.</p>

      {{-- Form --}}
      <form method="POST" action="{{ route('register') }}" class="mt-8 space-y-6">
        @csrf

        {{-- Name --}}
        <div>
          <label for="name" class="block text-sm font-medium text-gray-700">Full name</label>
          <input id="name" name="name" type="text" value="{{ old('name') }}" required
                 class="mt-2 block w-full rounded-md border-gray-300 focus:border-red-500 focus:ring-red-500"
                 placeholder="Your name">
          @error('name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        {{-- Email --}}
        <div>
          <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
          <input id="email" name="email" type="email" value="{{ old('email') }}" required
                 class="mt-2 block w-full rounded-md border-gray-300 focus:border-red-500 focus:ring-red-500"
                 placeholder="you@example.com">
          @error('email')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        {{-- Password --}}
        <div>
          <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
          <input id="password" name="password" type="password" required
                 class="mt-2 block w-full rounded-md border-gray-300 focus:border-red-500 focus:ring-red-500"
                 placeholder="********">
          @error('password')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        {{-- Confirm --}}
        <div>
          <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm password</label>
          <input id="password_confirmation" name="password_confirmation" type="password" required
                 class="mt-2 block w-full rounded-md border-gray-300 focus:border-red-500 focus:ring-red-500"
                 placeholder="********">
        </div>

        {{-- T&C (optional) --}}
        <div class="flex items-start">
          <input id="agree" type="checkbox" class="mt-1 h-4 w-4 rounded border-gray-300 text-red-600 focus:ring-red-500">
          <label for="agree" class="ml-2 text-sm text-gray-600">
            I agree to the <a class="text-red-500 hover:text-red-600" href="#">Terms</a> &amp;
            <a class="text-red-500 hover:text-red-600" href="#">Privacy</a>
          </label>
        </div>

        {{-- Primary submit --}}
        <button type="submit"
                class="w-full inline-flex justify-center rounded-md bg-red-500 px-4 py-2.5 text-white font-medium hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
          Create account
        </button>

        {{-- Google (ถ้ามี route social) --}}
        @if (Route::has('google.redirect'))
          <a href="{{ route('google.redirect') }}"
             class="w-full inline-flex items-center justify-center gap-3 rounded-md border px-4 py-2.5 text-gray-900 hover:bg-gray-50">
            <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="h-5 w-5" alt="">
            Sign up with Google
          </a>
        @endif

        {{-- Link to login --}}
        @if (Route::has('login'))
          <p class="text-center text-sm text-gray-600">
            Already have an account?
            <a href="{{ route('login') }}" class="text-red-500 hover:text-red-600 font-semibold">Sign in</a>
          </p>
        @endif
      </form>
    </div>

    {{-- RIGHT: hero image + small logo --}}
    <div class="hidden lg:flex relative items-center justify-center bg-gray-50">
    
      <div class="px-8">
        <img src="{{ asset('images/logo/LoginLogo.png') }}" alt="Hero" class="max-h-[80vh] object-contain">
        <div class="mt-4 text-center text-2xl font-extrabold tracking-wide text-gray-800">
          UNLEASH YOUR POWER
        </div>
      </div>
    </div>
  </div>
</x-guest-layout>
