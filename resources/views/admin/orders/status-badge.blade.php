@php
    $style = match($status) {
        'processing' => 'bg-yellow-100 text-yellow-700',
        'shipped' => 'bg-blue-100 text-blue-700',
        'completed' => 'bg-green-100 text-green-700',
        default => 'bg-red-100 text-red-700'
    };
@endphp

<span class="rounded-full px-4 py-2 text-xs font-semibold {{ $style }}">
    {{ ucfirst($status) }}
</span>