<?php

namespace App\Providers\Filament;

use App\Filament\Pages\HomePages;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('')
            ->login()
            ->registration()
            ->colors([
                'primary' => Color::Rose,
                'gray' => Color::Gray,
                'info' => Color::Blue,
                'danger' => Color::Indigo,
                'success' => Color::Emerald,
                'warning' => Color::Orange,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                // Pages\Homepages::class,
                HomePages::class
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                // Widgets\AccountWidget::class,
                // Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->plugins([
                // \BezhanSalleh\FilamentShield\FilamentShieldPlugin::make(),
                FilamentShieldPlugin::make()
                    ->gridColumns([
                        'default' => 1,
                        'sm' => 2,
                        'lg' => 3
                    ])
                    ->sectionColumnSpan(1)
                    ->checkboxListColumns([
                        'default' => 1,
                        'sm' => 1,
                        'lg' => 2,
                    ])
                    ->resourceCheckboxListColumns([
                        'default' => 1,
                        'sm' => 2,
                    ]),
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->topNavigation()
            ->spa()
            ->font('tahoma')
            ->sidebarWidth('16rem')
            ->navigationGroups([
                NavigationGroup::make()
                    ->label('Produk')
                // ->icon('heroicon-o-squares-2x2')
                ,
                NavigationGroup::make()
                    ->label('Kendaraan')
                    // ->icon('heroicon-o-cog-6-tooth')
                    ->collapsed(),
                NavigationGroup::make()
                    ->label('Settings')
                // ->icon('heroicon-o-cog-8-tooth')
                ,
            ]);
    }
}
