@php
    use Filament\Support\Enums\MaxWidth;

    $navigation = filament()->getNavigation();
@endphp

<x-filament-panels::layout.base :livewire="$livewire">

    <div class="wrapper">

        {{-- Menu Navigasi --}}
        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::TOPBAR_BEFORE, scopes: $livewire->getRenderHookScopes()) }}

        {{-- Landing Page MEnu --}}
        @if (filament()->hasTopNavigation() && filament()->hasNavigation() && filament()->auth()->check())
            <x-filament-panels::topbar :navigation="$navigation" />
        @elseif (!filament()->hasTopNavigation() && filament()->hasNavigation() && filament()->auth()->check())
            <x-filament-panels::navbar :navigation="$navigation" />
            <x-filament-panels::sidebar :navigation="$navigation" />
        @endif

        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::TOPBAR_AFTER, scopes: $livewire->getRenderHookScopes()) }}

        <div class="content-wrapper">
            {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::CONTENT_START, scopes: $livewire->getRenderHookScopes()) }}
            


            {{ $slot }}
            {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::CONTENT_END, scopes: $livewire->getRenderHookScopes()) }}
        </div>

    </div>



    {{-- Footer --}}
    {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::FOOTER, scopes: $livewire->getRenderHookScopes()) }}

</x-filament-panels::layout.base>
