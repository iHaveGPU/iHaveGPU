<x-app-layout>
  {{-- HERO --}}
  <section class="relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-r from-slate-900 via-slate-800 to-slate-700"></div>
    <div class="absolute -top-1/3 -right-1/3 w-[600px] h-[600px] rounded-full blur-3xl opacity-20 bg-cyan-400"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24 grid lg:grid-cols-2 gap-10 items-center">
      <div class="text-white">
        <p class="text-cyan-300 font-semibold tracking-wide uppercase">iHaveGPU Store</p>
        <h1 class="mt-3 text-3xl sm:text-4xl lg:text-5xl font-black leading-tight">
          ร้านขาย <span class="text-cyan-300">GPU</span> อันดับ 1 ของไทย.
        </h1>
        <p class="mt-4 text-slate-200 max-w-xl">
          เราไม่เหมือน iHaveCPU เพราะเราคือ iHaveGPU
        </p>

        <div class="mt-6 flex flex-wrap gap-3">
          <a href="{{ route('products.index') }}"
             class="inline-flex items-center px-5 py-3 rounded-xl bg-cyan-400 text-slate-900 font-semibold hover:bg-cyan-300">
            ซื้ออุปกรณ์
          </a>
          @if(Route::has('sets.index'))
            <a href="{{ route('sets.index') }}"
               class="inline-flex items-center px-5 py-3 rounded-xl bg-white/10 text-white hover:bg-white/20">
              ชุดคอมแนะนำ
            </a>
          @endif
        </div>
      </div>

      <div class="relative">
        <img src="{{ asset('images/hero-gpu.png') }}"
             onerror="this.src='https://images.unsplash.com/photo-1517336714731-489689fd1ca8?q=80&w=1600&auto=format&fit=crop'"
             alt="Hero"
             class="w-full h-72 sm:h-96 object-cover rounded-2xl shadow-2xl ring-1 ring-white/10" />
      </div>
    </div>
  </section>

  {{-- CATEGORY CHIPS --}}
  @if($topCategories->count())
  <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="flex items-center justify-between mb-4">
      <h2 class="text-xl font-bold">หมวดหมู่ยอดนิยม</h2>
      <a href="{{ route('categories.index') }}" class="text-blue-600 hover:underline text-sm">ดูทั้งหมด</a>
    </div>

    <div class="flex flex-wrap gap-3">
      @foreach($topCategories as $cat)
        <a href="{{ route('categories.show', $cat->slug) }}"
           class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white shadow-sm ring-1 ring-gray-200 hover:shadow transition">
          <span class="font-medium">{{ $cat->name }}</span>
        </a>
      @endforeach
    </div>
  </section>
  @endif

  {{-- FEATURED PRODUCTS --}}
  <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-6">
    <div class="flex items-center justify-between mb-4">
      <h2 class="text-xl font-bold">สินค้าแนะนำ</h2>
      <a href="{{ route('products.index') }}" class="text-blue-600 hover:underline text-sm">ดูทั้งหมด</a>
    </div>

    @if($featuredProducts->count())
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        @foreach($featuredProducts as $p)
          <x-product-card :product="$p" />
        @endforeach
      </div>
    @else
      <div class="p-6 bg-white rounded-xl ring-1 ring-gray-100 text-gray-500">ยังไม่มีสินค้า</div>
    @endif
  </section>

  {{-- USPs --}}
  <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
      <div class="p-5 bg-white rounded-2xl ring-1 ring-gray-100 shadow-sm">
        <div class="text-lg font-semibold">ทำได้เหมือน iHaveCPU เพราะเราคือ iHaveGPU</div>
        <p class="text-gray-500 text-sm mt-1">ไม่ได้เหมือนแต่ก๊อปมาทั้งเว็ป</p>
      </div>
      <div class="p-5 bg-white rounded-2xl ring-1 ring-gray-100 shadow-sm">
        <div class="text-lg font-semibold">เปลี่ยนคืนง่าย</div>
        <p class="text-gray-500 text-sm mt-1">ภายใน 7 วันตามเงื่อนไข</p>
      </div>
      <div class="p-5 bg-white rounded-2xl ring-1 ring-gray-100 shadow-sm">
        <div class="text-lg font-semibold">ชำระเงินปลอดภัย</div>
        <p class="text-gray-500 text-sm mt-1">รองรับชำระหลายช่องทาง</p>
      </div>
    </div>
  </section>

  {{-- BRANDS --}}
  @if($brands->count())
  <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-2xl ring-1 ring-gray-100 p-6">
      <div class="text-center font-semibold text-gray-600 mb-4">แบรนด์ที่เราไว้ใจ</div>
      <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-6 gap-6 items-center">
        @foreach($brands as $b)
          <div class="flex items-center justify-center">
            @if(!empty($b->logo_path))
              <img src="{{ Storage::disk('public')->url($b->logo_path) }}"
                   alt="{{ $b->name }}" class="h-10 object-contain grayscale hover:grayscale-0 transition">
            @else
              <div class="px-3 py-2 rounded-lg bg-gray-50 ring-1 ring-gray-100 text-gray-600 text-sm">{{ $b->name }}</div>
            @endif
          </div>
        @endforeach
      </div>
    </div>
  </section>
  @endif

  {{-- CTA BOTTOM --}}
  <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="relative overflow-hidden rounded-3xl ring-1 ring-gray-200 bg-gradient-to-r from-indigo-600 to-purple-600">
      <div class="p-8 lg:p-12 text-white">
        <h3 class="text-2xl font-bold">ไม่มั่นใจสเปก? ให้เราช่วยเลือก</h3>
        <p class="mt-2 text-white/90 max-w-2xl">บอกงบและงานที่ใช้ เราแนะนำอุปกรณ์และชุดคอมที่คุ้มสุดให้คุณ</p>
        <div class="mt-5">
          <a href="{{ route('contact') }}" class="inline-flex items-center px-5 py-3 rounded-xl bg-white text-indigo-700 font-semibold hover:bg-white/90">
            ติดต่อเรา
          </a>
        </div>
      </div>
    </div>
  </section>
</x-app-layout>
