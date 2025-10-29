<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl">ติดต่อเรา</h2>
  </x-slot>

  <div class="max-w-5xl mx-auto py-6 space-y-8">
    {{-- ช่องทางการติดต่อ (บริษัท) --}}
    @if($channels->has('general'))
      <div class="bg-white p-6 rounded shadow">
        <h3 class="text-lg font-semibold mb-3">ช่องทางการติดต่อ</h3>
        <ul class="space-y-2">
          @foreach($channels['general'] as $c)
            <li>
              <span class="font-medium">{{ $c->label }}:</span>
              <span class="text-gray-700">{{ $c->value }}</span>
            </li>
          @endforeach
        </ul>
      </div>
    @endif

    {{-- โซเชียล --}}
    @if($channels->has('social'))
      <div class="bg-white p-6 rounded shadow">
        <h3 class="text-lg font-semibold mb-3">ช่องทางโซเชี่ยล</h3>
        <ul class="grid sm:grid-cols-2 gap-2">
          @foreach($channels['social'] as $c)
            <li>
              <span class="font-medium">{{ $c->label }}:</span>
              <span class="text-gray-700">{{ $c->value }}</span>
            </li>
          @endforeach
        </ul>
      </div>
    @endif

    {{-- สอบถามข้อมูลสินค้าเพิ่มเติม / องค์กร / การตลาด --}}
    @if($channels->has('sales') || $channels->has('marketing'))
      <div class="bg-white p-6 rounded shadow space-y-6">
        @if($channels->has('sales'))
          <div>
            <h3 class="text-lg font-semibold mb-2">ติดต่อสอบถาม / ลูกค้าองค์กร</h3>
            <ul class="space-y-1">
              @foreach($channels['sales'] as $c)
                <li><span class="font-medium">{{ $c->label }}:</span> {{ $c->value }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        @if($channels->has('marketing'))
          <div>
            <h3 class="text-lg font-semibold mb-2">ฝ่ายการตลาด</h3>
            <ul class="space-y-1">
              @foreach($channels['marketing'] as $c)
                <li><span class="font-medium">{{ $c->label }}:</span> {{ $c->value }}</li>
              @endforeach
            </ul>
          </div>
        @endif
      </div>
    @endif
  </div>
</x-app-layout>
