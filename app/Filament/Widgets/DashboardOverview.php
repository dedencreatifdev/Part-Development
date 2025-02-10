<?php

namespace App\Filament\Widgets;

use App\Models\Produk;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardOverview extends BaseWidget
{

    // protected ?string $heading = 'Analytics';
    // protected ?string $description = 'An overview of some analytics.';
    protected static ?int $sort = 2;
    // use HasPageShield;
    use HasWidgetShield;

    // protected int | string | array $columnSpan = [
    //     'default'=>2,
    //     'sm' => 3,
    //     'md' => 4,
    //     'xl' => 6,
    // ];

    public function getWidgetData(): array
    {
        return [
            'stats' => [
                'total' => 100,
            ],
        ];
    }

    protected function getStats(): array
    {
        return [
            Stat::make('Produk List', Produk::count())
                ->icon('heroicon-o-squares-2x2')
                ->description('Item (Lihat Semua)')
                ->color('primary')
                ->descriptionIcon('heroicon-o-square-3-stack-3d', IconPosition::Before)
                ->url(route('filament.admin.resources.produks.index')),
            Stat::make('Pesanan', '86%')
                ->icon('heroicon-o-envelope-open')
                ->description('(Dalam Proses Development)')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
                Stat::make('Estimasi', '50%')
                ->icon('heroicon-o-newspaper')
                ->description('(Dalam Proses Development)')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger'),
            Stat::make('Booking Service', '21%')
                ->description('(Dalam Proses Development)')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger'),

        ];
    }

}
