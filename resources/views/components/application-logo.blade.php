@props(['class' => 'h-16']) {{-- ปรับค่าเริ่มต้นเป็น h-16 ได้เลย --}}
<a href="{{ route('home') }}" class="block">
    <img
        src="{{ asset('images/logo/logo.png') }}"  {{-- ใช้ไฟล์ของคุณ --}}
        alt="Logo"
        {{ $attributes->merge(['class' => $class.' w-auto mx-auto']) }}
        loading="lazy"
    >
</a>
