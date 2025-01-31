@props([
    'tag' => 'td',
])

<{{ $tag }}
    {{ $attributes->class(['-']) }}
>
    {{ $slot }}
</{{ $tag }}>
