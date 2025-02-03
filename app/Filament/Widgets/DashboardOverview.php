<?php

namespace App\Filament\Widgets;

use App\Models\Produk;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardOverview extends BaseWidget
{

    protected ?string $heading = 'Analytics';
    protected ?string $description = 'An overview of some analytics.';
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [

            Stat::make('Produk List', Produk::count())
                ->description('Item')
                ->descriptionIcon('heroicon-o-arrow-trending-up', IconPosition::Before)
                ->icon('heroicon-m-clipboard-document-check')

                ->url(route('filament.admin.resources.produks.index')),
            Stat::make('Pesanan', '-')
                ->description('32k increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Estimasi', '-')
                ->description('7% increase')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger'),
            Stat::make('Booking Service', '21%')
                ->description('7% increase')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger'),

        ];
    }

    public function getHeaderWidgetsColumns(): int | array
    {
        return [
            'default' => 2
        ];
    }
}
