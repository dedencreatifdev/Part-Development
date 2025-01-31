@props([
    'active' => false,
    'activeChildItems' => false,
    'activeIcon' => null,
    'badge' => null,
    'badgeColor' => null,
    'badgeTooltip' => null,
    'childItems' => [],
    'first' => false,
    'grouped' => false,
    'icon' => null,
    'last' => false,
    'shouldOpenUrlInNewTab' => false,
    'sidebarCollapsible' => true,
    'subGrouped' => false,
    'url',
])

<li class="nav-item">
    <a {{ \Filament\Support\generate_href_html($url, $shouldOpenUrlInNewTab) }}
        class="nav-link {{ $active ? 'active' : '' }}">
        {{-- <i class="nav-icon fas fa-th"></i> --}}

        <x-filament::icon alias="panels::topbar.global-search.field" icon="{{ $icon }}" wire:target="search"
            class="h-5 w-5 text-gray-500 dark:text-gray-400 mr-2" style="height: 22px" />

        <p>
            {{ $slot }}
            <span class="right badge badge-danger">New</span>
        </p>
    </a>
</li>
