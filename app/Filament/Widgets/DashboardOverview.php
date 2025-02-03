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
                ->icon('heroicon-o-squares-2x2')
                ->description('Item')
                ->descriptionIcon('heroicon-o-square-3-stack-3d', IconPosition::Before)
                ->url(route('filament.admin.resources.produks.index')),
            Stat::make('Pesanan', '-')
                ->icon('heroicon-o-envelope-open')
                ->description('32k increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
                Stat::make('Estimasi', '-')
                ->icon('heroicon-o-newspaper')
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
