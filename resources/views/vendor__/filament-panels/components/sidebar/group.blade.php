@php
    use Filament\Support\Enums\IconSize;
@endphp

@props([
    'active' => false,
    'collapsible' => true,
    'icon' => null,
    'items' => [],
    'label' => null,
    'sidebarCollapsible' => true,
    'subNavigation' => false,

    'badge' => null,
    'badgeColor' => null,
    'badgeTooltip' => null,
    'color' => 'gray',
    'disabled' => false,
    'href' => null,
    'iconAlias' => null,
    'iconColor' => null,
    'iconSize' => IconSize::Medium,
    'image' => null,
    'keyBindings' => null,
    'loadingIndicator' => true,
    'spaMode' => null,
    'tag' => 'button',
    'target' => null,
    'tooltip' => null,
    'class' => '',
])

@php
    $sidebarCollapsible = $sidebarCollapsible && filament()->isSidebarCollapsibleOnDesktop();
    $hasDropdown = filled($label) && filled($icon) && $sidebarCollapsible;
@endphp

@php
    $buttonClasses = \Illuminate\Support\Arr::toCssClasses([
        'fi-dropdown-list-item flex w-full items-center gap-2 whitespace-nowrap rounded-md p-2 text-sm transition-colors duration-75 outline-none disabled:pointer-events-none disabled:opacity-70',
        'pointer-events-none opacity-70' => $disabled,
        match ($color) {
            'gray' => 'hover:bg-gray-50 focus-visible:bg-gray-50 dark:hover:bg-white/5 dark:focus-visible:bg-white/5',
            default
                => 'fi-color-custom hover:bg-custom-50 focus-visible:bg-custom-50 dark:hover:bg-custom-400/10 dark:focus-visible:bg-custom-400/10',
        },
        // @deprecated `fi-dropdown-list-item-color-*` has been replaced by `fi-color-*` and `fi-color-custom`.
        is_string($color) ? "fi-dropdown-list-item-color-{$color}" : null,
        is_string($color) ? "fi-color-{$color}" : null,
    ]);

    $buttonStyles = \Illuminate\Support\Arr::toCssStyles([
        \Filament\Support\get_color_css_variables($color, shades: [50, 400], alias: 'dropdown.list.item') =>
            $color !== 'gray',
    ]);

    $iconColor ??= $color;

    $iconClasses = \Illuminate\Support\Arr::toCssClasses([
        '',
        match ($iconSize) {
            IconSize::Small, 'sm' => 'h-1 w-1',
            IconSize::Medium, 'md' => 'h-1 w-1',
            IconSize::Large, 'lg' => 'h-1 w-1',
            default => $iconSize,
        },
        match ($iconColor) {
            'gray' => 'text-gray-400 dark:text-gray-500',
            default => 'text-custom-500 dark:text-custom-400',
        },
    ]);

    $iconStyles = \Illuminate\Support\Arr::toCssStyles([
        \Filament\Support\get_color_css_variables($iconColor, shades: [400, 500], alias: 'dropdown.list.item.icon') =>
            $iconColor !== 'gray',
        'height:20px',
    ]);

    $imageClasses = 'fi-dropdown-list-item-image h-5 w-5 rounded-full bg-cover bg-center';

    $labelClasses = \Illuminate\Support\Arr::toCssClasses([
        'fi-dropdown-list-item-label flex-1 truncate text-start',
        match ($color) {
            'gray' => 'text-gray-700 dark:text-gray-200',
            default => 'text-custom-600 dark:text-custom-400 ',
        },
    ]);

    $labelStyles = \Illuminate\Support\Arr::toCssStyles([
        \Filament\Support\get_color_css_variables($color, shades: [400, 600], alias: 'dropdown.list.item.label') =>
            $color !== 'gray',
    ]);

    $wireTarget = $loadingIndicator
        ? $attributes
            ->whereStartsWith(['wire:target', 'wire:click'])
            ->filter(fn($value): bool => filled($value))
            ->first()
        : null;

    $hasLoadingIndicator = filled($wireTarget);

    if ($hasLoadingIndicator) {
        $loadingIndicatorTarget = html_entity_decode($wireTarget, ENT_QUOTES);
    }

    $hasTooltip = filled($tooltip);
@endphp

@if ($label)

    <li class="nav-header">{{ $label }}</li>
    @foreach ($items as $item)
        @php
            $itemIcon = $item->getIcon();
            $itemActiveIcon = $item->getActiveIcon();

            if ($icon) {
                if ($hasDropdown || (blank($itemIcon) && blank($itemActiveIcon))) {
                    $itemIcon = null;
                    $itemActiveIcon = null;
                } else {
                    throw new \Exception(
                        'Navigation group [' .
                            $label .
                            '] has an icon but one or more of its items also have icons. Either the group or its items can have icons, but not both. This is to ensure a proper user experience.',
                    );
                }
            }
        @endphp



        <li class="nav-item {{ $active ? 'menu-open' : '' }} ">
            <a href="#" class="nav-link {{ $active ? 'active' : '' }}">
                {{-- <i class="nav-icon fas fa-tachometer-alt"></i> --}}

                <x-filament::icon alias="panels::topbar.global-search.field" icon="{{ $icon }}"
                    wire:target="search" class="h-5 w-5 text-gray-500 dark:text-gray-400 mr-2" style="height: 22px"/>

                <p>
                    {{ $label}}
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <x-filament-panels::sidebar.item-grup :active="$item->isActive()" :active-child-items="$item->isChildItemsActive()" :active-icon="$itemActiveIcon"
                    :badge="$item->getBadge()" :badge-color="$item->getBadgeColor()" :badge-tooltip="$item->getBadgeTooltip()" :child-items="$item->getChildItems()" :first="$loop->first"
                    :grouped="filled($label)" :icon="$itemIcon" :last="$loop->last" :should-open-url-in-new-tab="$item->shouldOpenUrlInNewTab()" :sidebar-collapsible="$sidebarCollapsible"
                    :url="$item->getUrl()">
                    {{ $item->getLabel() }}
                </x-filament-panels::sidebar.item-grup>
            </ul>
        </li>
    @endforeach
@else
    @foreach ($items as $item)
        @php
            $itemIcon = $item->getIcon();
            $itemActiveIcon = $item->getActiveIcon();

            if ($icon) {
                if ($hasDropdown || (blank($itemIcon) && blank($itemActiveIcon))) {
                    $itemIcon = null;
                    $itemActiveIcon = null;
                } else {
                    throw new \Exception(
                        'Navigation group [' .
                            $label .
                            '] has an icon but one or more of its items also have icons. Either the group or its items can have icons, but not both. This is to ensure a proper user experience.',
                    );
                }
            }
        @endphp

        <x-filament-panels::sidebar.item :active="$item->isActive()" :active-child-items="$item->isChildItemsActive()" :active-icon="$itemActiveIcon" :badge="$item->getBadge()"
            :badge-color="$item->getBadgeColor()" :badge-tooltip="$item->getBadgeTooltip()" :child-items="$item->getChildItems()" :first="$loop->first" :grouped="filled($label)"
            :icon="$itemIcon" :last="$loop->last" :should-open-url-in-new-tab="$item->shouldOpenUrlInNewTab()" :sidebar-collapsible="$sidebarCollapsible" :url="$item->getUrl()">
            {{ $item->getLabel() }}
        </x-filament-panels::sidebar.item>
    @endforeach
@endif
