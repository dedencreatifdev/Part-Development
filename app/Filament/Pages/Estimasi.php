<?php

namespace App\Filament\Pages;

use App\Models\Estimasi as ModelsEstimasi;
use App\Models\Kendaraan;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\WithPagination;

class Estimasi extends Page implements HasTable, HasForms
{
    use InteractsWithTable, InteractsWithForms;

    protected static ?string $model = Estimasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Daftar Estimasi';
    protected static ?string $navigationGroup = 'Service';
    protected static ?string $title = 'Daftar Estimasi';
    protected ?string $subheading = 'Custom Page Subheading';

    protected static string $view = 'filament.pages.estimasi';

    // public static function form(Form $form): Form
    // {
    //     return $form
    //         ->schema([]);
    // }

    public static function table(Table $table): Table
    {
        return $table
            ->query(ModelsEstimasi::query())
            ->columns([
                TextColumn::make('kode_jenis')
            ])
            ->actions([
                ViewAction::make()
            ]);
    }
}
