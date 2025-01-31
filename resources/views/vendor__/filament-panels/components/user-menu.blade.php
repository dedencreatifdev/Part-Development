@php
    $user = filament()->auth()->user();
    $items = filament()->getUserMenuItems();

    $profileItem = $items['profile'] ?? ($items['account'] ?? null);
    $profileItemUrl = $profileItem?->getUrl();
    $profilePage = filament()->getProfilePage();
    $hasProfileItem = filament()->hasProfile() || filled($profileItemUrl);

    $logoutItem = $items['logout'] ?? null;

    $items = \Illuminate\Support\Arr::except($items, ['account', 'logout', 'profile']);
@endphp

{{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::USER_MENU_BEFORE) }}

<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="fas fa-th-large"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

        <x-slot name="trigger">
            <button aria-label="{{ __('filament-panels::layout.actions.open_user_menu.label') }}" type="button"
                class="shrink-0">
                <x-filament-panels::avatar.user :user="$user" />
            </button>
        </x-slot>

        <span class="dropdown-item dropdown-header bg-primary">
            {{-- Profile --}}
            @if ($profileItem?->isVisible() ?? true)
                {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::USER_MENU_PROFILE_BEFORE) }}

                @if ($hasProfileItem)
                    <x-filament::dropdown.list>
                        <x-filament::dropdown.list.item :color="$profileItem?->getColor()" :icon="$profileItem?->getIcon() ??
                            (\Filament\Support\Facades\FilamentIcon::resolve('panels::user-menu.profile-item') ??
                                'heroicon-m-user-circle')" :href="$profileItemUrl ?? filament()->getProfileUrl()"
                            :target="$profileItem?->shouldOpenUrlInNewTab() ?? false ? '_blank' : null" tag="a">
                            {{ $profileItem?->getLabel() ?? (($profilePage ? $profilePage::getLabel() : null) ?? filament()->getUserName($user)) }}
                        </x-filament::dropdown.list.item>
                    </x-filament::dropdown.list>
                @else
                    <div class="user-panel d-flex">
                        <div class="image">
                            <img src="{{ asset('storage/style') }}/dist/img/user2-160x160.jpg"
                                class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                            <a href="#" class="d-block text-white">
                                {{ $profileItem?->getLabel() ?? filament()->getUserName($user) }}
                            </a>
                        </div>
                    </div>
                @endif

                {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::USER_MENU_PROFILE_AFTER) }}
            @endif
        </span>

        <div class="dropdown-divider"></div>

        @foreach ($items as $key => $item)
            @php
                $itemPostAction = $item->getPostAction();
            @endphp

            <x-filament::dropdown.list.item :action="$itemPostAction" :color="$item->getColor()" :href="$item->getUrl()" :icon="$item->getIcon()"
                :method="filled($itemPostAction) ? 'post' : null" :tag="filled($itemPostAction) ? 'form' : 'a'" :target="$item->shouldOpenUrlInNewTab() ? '_blank' : null">
                {{ $item->getLabel() }}
            </x-filament::dropdown.list.item>

            <div class="dropdown-divider"></div>
        @endforeach

        <x-filament::dropdown.list.item :action="$logoutItem?->getUrl() ?? filament()->getLogoutUrl()" :color="$logoutItem?->getColor()" :icon="$logoutItem?->getIcon() ??
            (\Filament\Support\Facades\FilamentIcon::resolve('panels::user-menu.logout-button') ??
                'heroicon-m-arrow-left-on-rectangle')" method="post"
            tag="form">
            {{ $logoutItem?->getLabel() ?? __('filament-panels::layout.actions.logout.label') }}
        </x-filament::dropdown.list.item>

        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
    </div>
</li>

{{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::USER_MENU_AFTER) }}
