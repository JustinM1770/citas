@props(['title' => ''])

<div {{ $attributes->merge(['class' => 'bg-white rounded-lg shadow-sm border border-gray-200 p-6']) }}>
    @if($title)
        <h3 class="text-lg font-semibold text-black mb-4">{{ $title }}</h3>
    @endif
    
    {{ $slot }}
</div>
