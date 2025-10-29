<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">{{ __('ติดต่อเรา') }}</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-6 space-y-8">
        @foreach($channels as $group => $items)
            <div class="bg-white p-6 rounded shadow">
                <h3 class="font-semibold text-lg mb-4 capitalize">{{ $group }}</h3>
                <ul class="space-y-2">
                    @foreach($items as $c)
                        <li class="flex items-start justify-between">
                            <div>
                                <div class="font-medium">{{ $c->label }}</div>
                                <div class="text-gray-700">
                                    @if($c->url)
                                        <a href="{{ $c->url }}" class="text-blue-600 hover:underline">{{ $c->value ?? $c->url }}</a>
                                    @else
                                        {{ $c->value }}
                                    @endif
                                </div>
                            </div>
                            @if($c->type === 'phone' && $c->url)
                                <a href="{{ $c->url }}" class="px-3 py-1 text-sm bg-blue-50 text-blue-700 rounded">Call</a>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
</x-app-layout>
