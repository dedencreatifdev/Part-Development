@props([
    'fullHeight' => false,
])

@php
    use Filament\Pages\SubNavigationPosition;

    $subNavigation = $this->getCachedSubNavigation();
    $subNavigationPosition = $this->getSubNavigationPosition();
    $widgetData = $this->getWidgetData();
@endphp

<div>

    @if (filament()->hasTopNavigation() && filament()->hasNavigation() && filament()->auth()->check())
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="content">
                <div class="container">
                    {{ $slot }}
                </div>
            </div>
        </div>
    @elseif (!filament()->hasTopNavigation() && filament()->hasNavigation() && filament()->auth()->check())
        @if ($header = $this->getHeader())
            {{ $header }}
        @elseif ($heading = $this->getHeading())
            @php
                $subheading = $this->getSubheading();
            @endphp

            <x-filament-panels::header :actions="$this->getCachedHeaderActions()" :breadcrumbs="filament()->hasBreadcrumbs() ? $this->getBreadcrumbs() : []" :heading="$heading" :subheading="$subheading">
                @if ($heading instanceof \Illuminate\Contracts\Support\Htmlable)
                    <x-slot name="heading">
                        {{ $heading }}
                    </x-slot>
                @endif

                @if ($subheading instanceof \Illuminate\Contracts\Support\Htmlable)
                    <x-slot name="subheading">
                        {{ $subheading }}
                    </x-slot>
                @endif
            </x-filament-panels::header>
        @endif

        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::PAGE_START, scopes: $this->getRenderHookScopes()) }}

        <section class="content">
            <div class="container-fluid">
                {{ $slot }}
            </div>
        </section>
        
        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::PAGE_END, scopes: $this->getRenderHookScopes()) }}
    @endif
</div>
