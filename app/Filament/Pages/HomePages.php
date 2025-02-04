<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\DashboardOverview;
use App\Filament\Widgets\ProdukListTable;
use Filament\Pages\Page;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class HomePages extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationLabel = 'Dashboard';
    protected static ?string $title = 'Dashboard';
    protected ?string $subheading = 'Custom Page Subheading';

    protected static string $view = 'filament.pages.home-pages';

    protected static ?string $slug = '/';




    public static function canAccess(): bool
    {
        return true; //Auth()->user()->canManageSettings();
    }

    //     public function getFooter(): ?View
    // {
    //     return view('filament.pages.footer.dashboard-footer');
    // }

    protected function getHeaderWidgets(): array
    {
        return [
            // DashboardOverview::class,
            // ProdukListTable::class,
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            DashboardOverview::class,
            ProdukListTable::class,
        ];
    }
}
