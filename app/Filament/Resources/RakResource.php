<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RakResource\Pages;
use App\Filament\Resources\RakResource\RelationManagers;
use App\Models\Rak;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn\TextColumnSize;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RakResource extends Resource
{
    protected static ?string $model = Rak::class;
    // use HasPageShield;
    protected static ?string $navigationIcon = 'heroicon-o-bars-arrow-down';
    protected static ?string $navigationGroup = 'Produk';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('no_rak')
                    ->required()
                    ->maxLength(15),
                Forms\Components\FileUpload::make('image')
                    ->image(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Stack::make([
                    // Columns
                    Tables\Columns\ImageColumn::make('image')
                        ->size('100%')
                        ->defaultImageUrl(url('https://portuguese.printedpaperbox.com/photo/ps33278125-custom_printed_hardbox_magnet_box_packaging_customised_luxury_foldable_magnetic_gift_box_with_lid.jpg')),
                    Tables\Columns\TextColumn::make('no_rak')
                        ->weight(FontWeight::Bold)
                        ->size(TextColumnSize::ExtraSmall)
                        ->searchable(),
                ]),
            ])
            ->contentGrid([
                'default' => 4,
                'md' => 4,
                'lg' => 6,
                'xl' => 6,
                '2xl' => 8,
            ])
            ->paginated([16, 25, 50, 100, 'all'])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\ViewAction::make(),
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageRaks::route('/'),
        ];
    }
}
