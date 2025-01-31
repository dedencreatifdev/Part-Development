@props([
    'footer' => null,
    'header' => null,
    'headerGroups' => null,
    'reorderable' => false,
    'reorderAnimationDuration' => 300,
])

<table {{ $attributes->class(['table table-sm table-striped']) }}>
    @if ($header)
        <thead class="bg-primary">
            @if ($headerGroups)
                <tr>
                    {{ $headerGroups }}
                </tr>
            @endif

            <tr>
                {{ $header }}
            </tr>
        </thead>
    @endif

    <tbody
        @if ($reorderable) x-on:end.stop="$wire.reorderTable($event.target.sortable.toArray())"
            x-sortable
            data-sortable-animation-duration="{{ $reorderAnimationDuration }}" @endif
        class="-">
        {{ $slot }}
    </tbody>

    @if ($footer)
        <tfoot class="-">
            <tr>
                {{ $footer }}
            </tr>
        </tfoot>
    @endif
</table>
