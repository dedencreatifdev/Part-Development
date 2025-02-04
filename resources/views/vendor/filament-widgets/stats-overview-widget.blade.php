@php
    $columns = $this->getColumns();
    $heading = $this->getHeading();
    $description = $this->getDescription();
    $hasHeading = filled($heading);
    $hasDescription = filled($description);
@endphp

<x-filament-widgets::widget class="grid fi-wi-stats-overview gap-y-4">
    @if ($hasHeading || $hasDescription)
        <div class="grid fi-wi-stats-overview-header gap-y-1">
            @if ($hasHeading)
                <h3
                    class="text-base font-semibold leading-6 fi-wi-stats-overview-header-heading col-span-full text-gray-950 dark:text-white"
                >
                    {{ $heading }}
                </h3>
            @endif

            @if ($hasDescription)
                <p
                    class="overflow-hidden text-sm text-gray-500 break-words fi-wi-stats-overview-header-description dark:text-gray-400"
                >
                    {{ $description }}
                </p>
            @endif
        </div>
    @endif

    <div
        @if ($pollingInterval = $this->getPollingInterval())
            wire:poll.{{ $pollingInterval }}
        @endif
        @class([
            'fi-wi-stats-overview-stats-ctn grid gap-2',
            // 'sm:grid gap-2',
            'sm:grid-cols-3',
            'md:grid-cols-1' => $columns === 1,
            'md:grid-cols-2' => $columns === 2,
            'md:grid-cols-3' => $columns === 3,
            'grid-cols-2 sm:grid-cols-2 md:grid-cols-4 xl:grid-cols-4' => $columns === 4,
        ])
    >
        @foreach ($this->getCachedStats() as $stat)
            {{ $stat }}
        @endforeach
    </div>
</x-filament-widgets::widget>
