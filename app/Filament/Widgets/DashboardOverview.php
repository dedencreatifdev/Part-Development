<?php

namespace App\Filament\Widgets;

use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardOverview extends BaseWidget
{

    protected ?string $heading = 'Analytics';

    protected ?string $description = 'An overview of some analytics.';

    // protected int | string | array $columnSpan = [
    //     'default' => 2,
    //     'sm' => 2,
    //     'md' => 3,
    //     'xl' => 4,
    //     '2xl' => 8,
    // ];

    // protected ?int $coloum = 6;

    protected function getStats(): array
    {
        return [

            Stat::make('Unique views', '192.1k')
                ->description('32k increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up', IconPosition::Before),
            Stat::make('Unique views', '192.1k')
                ->description('32k increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Bounce rate', '21%')
                ->description('7% increase')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger'),
            Stat::make('Processed', '192.1k')
                ->description('3% increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'wire:click' => route('filament.admin.resources.produks.index')
                ]),

        ];
    }
}
