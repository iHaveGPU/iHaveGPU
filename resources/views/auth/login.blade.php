<x-guest-layout>
  <div class="min-h-screen grid grid-cols-1 lg:grid-cols-2 bg-white">
    {{-- LEFT: form --}}
    <div class="flex items-center justify-center py-10 px-6 sm:px-10 lg:px-16">
      {{-- lock to a nice readable width --}}
      <div class="w-full max-w-[420px]">
        {{-- Logo --}}
        <div class="mb-8 flex justify-center ">
          <img src="{{ asset('images/logo/logo.png') }}" alt="iHaveGPU" class="h-100">
        </div>

        <h1 class="text-2xl font-semibold text-gray-900">
          Welcome back! Please enter your details.
        </h1>

        <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-6">
          @csrf

          {{-- Email --}}
          <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                   placeholder="Enter your email"
                   class="mt-2 block w-full rounded-md border border-gray-300 px-3 py-2.5
                          focus:border-red-500 focus:ring-2 focus:ring-red-500/40">
            @error('email')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
          </div>

          {{-- Password --}}
          <div>
            <div class="flex items-center justify-between">
              <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
              @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm text-gray-500 hover:text-gray-700">
                  Forgot password
                </a>
              @endif
            </div>
            <input id="password" name="password" type="password" required placeholder="********"
                   class="mt-2 block w-full rounded-md border border-gray-300 px-3 py-2.5
                          focus:border-red-500 focus:ring-2 focus:ring-red-500/40">
            @error('password')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
          </div>

          {{-- Remember --}}
          <div class="flex items-center">
            <input id="remember_me" name="remember" type="checkbox"
                   class="h-4 w-4 rounded border-gray-300 text-red-600 focus:ring-red-500">
            <label for="remember_me" class="ml-2 block text-sm text-gray-700">Remember me</label>
          </div>

          {{-- Submit --}}
          <button type="submit"
                  class="w-full inline-flex justify-center rounded-md bg-red-500 px-4 py-3
                         text-white font-medium hover:bg-red-600 focus:outline-none
                         focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
            Sign in
          </button>

          {{-- Google (ถ้ามี route) --}}
          @if (Route::has('google.redirect'))
            <a href="{{ route('google.redirect') }}"
               class="w-full inline-flex items-center justify-center gap-3 rounded-md border px-4 py-2.5
                      text-gray-900 hover:bg-gray-50">
              <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="h-5 w-5" alt="">
              Sign in with Google
            </a>
          @endif

          {{-- Register --}}
          @if (Route::has('register'))
            <p class="text-center text-sm text-gray-600">
              Don’t have an account?
              <a href="{{ route('register') }}" class="text-red-500 hover:text-red-600 font-semibold">
                Sign up for free!
              </a>
            </p>
          @endif
        </form>
      </div>
    </div>

    {{-- RIGHT: hero --}}
    <div class="hidden lg:flex relative items-center justify-center bg-gray-50">
      {{-- hero wrapper keeps the image big but within viewport --}}
      <div class="px-10">
        <img src="{{ asset('images/logo/LoginLogo.png') }}"
             alt="Unleash your power"
             class="w-[800px] max-w-[100vw] h-auto max-h-[100vh] object-contain mx-auto">

      </div>
    </div>
  </div>
</x-guest-layout>
