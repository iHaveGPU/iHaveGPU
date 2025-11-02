{{-- resources/views/layouts/navigation.blade.php --}}
<nav class="bg-white border-b border-gray-100">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16">
      {{-- Left: Logo + Public nav --}}
      <div class="flex">
        <div class="shrink-0 flex items-center">
          <a href="{{ route('home') }}">
            <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
          </a>
        </div>

        {{-- Desktop Nav --}}
        <div class="hidden sm:flex sm:ms-10 sm:-my-px space-x-8">
          {{-- Public for everyone --}}
          <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
            {{ __('Home') }}
          </x-nav-link>

          @if (Route::has('sets.index'))
            <x-nav-link :href="route('sets.index')" :active="request()->routeIs('sets.*')">
              {{ __('Computer set') }}
            </x-nav-link>
          @endif

          @if (Route::has('products.index'))
            <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')">
              {{ __('Devices') }}
            </x-nav-link>
          @endif

          @if (Route::has('articles.index'))
            <x-nav-link :href="route('articles.index')" :active="request()->routeIs('articles.*')">
              {{ __('บทความ') }}
            </x-nav-link>
          @endif

          @if (Route::has('contact'))
            <x-nav-link :href="route('contact')" :active="request()->routeIs('contact')">
              {{ __('ติดต่อเรา') }}
            </x-nav-link>
          @endif

          {{-- Role-specific after login --}}
          @auth
            @if(auth()->user()->isAdmin())
              @if (Route::has('admin.dashboard'))
                <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                  {{ __('Dashboard') }}
                </x-nav-link>
              @endif
            @elseif(auth()->user()->isStaff())
              @if (Route::has('staff.dashboard'))
                <x-nav-link :href="route('staff.dashboard')" :active="request()->routeIs('staff.dashboard')">
                  {{ __('Dashboard') }}
                </x-nav-link>
              @endif
            @else
              @if (Route::has('cart'))
                <x-nav-link :href="route('cart')" :active="request()->routeIs('cart')">
                  {{ __('Cart') }}
                </x-nav-link>
              @endif
            @endif
          @endauth
        </div>
      </div>

      {{-- Right: User menu --}}
      <div class="hidden sm:flex sm:items-center sm:ms-6">
        @auth
          <x-dropdown align="right" width="48">
            <x-slot name="trigger">
              <button
                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md
                       text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                <div>{{ Auth::user()->name }}</div>
                <div class="ms-1">
                  <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                          clip-rule="evenodd" />
                  </svg>
                </div>
              </button>
            </x-slot>

            <x-slot name="content">
              <x-dropdown-link :href="route('profile.edit')">
                {{ __('Profile') }}
              </x-dropdown-link>

              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-dropdown-link :href="route('logout')"
                                 onclick="event.preventDefault(); this.closest('form').submit();">
                  {{ __('Log Out') }}
                </x-dropdown-link>
              </form>
            </x-slot>
          </x-dropdown>
        @else
          <div class="space-x-4">
            <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 text-sm">
              {{ __('Log in') }}
            </a>
            <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800 text-sm">
              {{ __('Register') }}
            </a>
          </div>
        @endauth
      </div>
    </div>
  </div>
</nav>