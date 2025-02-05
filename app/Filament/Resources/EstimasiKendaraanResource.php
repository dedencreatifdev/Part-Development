<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EstimasiKendaraanResource\Pages;
use App\Filament\Resources\EstimasiKendaraanResource\RelationManagers;
use App\Models\EstimasiKendaraan;
use App\Models\Kendaraan;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EstimasiKendaraanResource extends Resource
{
    protected static ?string $model = EstimasiKendaraan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Select::make('kode_jenis')
                    ->label('Kode Jenis')
                    ->options(Kendaraan::groupByRaw('kdjns')->groupByRaw('kendaraan')->pluck('kendaraan', 'kdjns'))
                    ->searchable(),
                FileUpload::make('image')
                    ->image()
                    ->required(),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Stack::make([
                    // Columns
                    ImageColumn::make('image')
                        ->size('100%'),
                    TextColumn::make('kode_jenis')
                        ->size(TextColumn\TextColumnSize::ExtraSmall)
                        ->weight(FontWeight::Bold)
                        ->searchable(),
                ])
            ])
            ->contentGrid([
                'default' => 2,
                'sm' => 3,
                'md' => 3,
                'lg' => 4,
                'xl' => 5,
                '2xl' => 6,
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEstimasiKendaraans::route('/'),
            'create' => Pages\CreateEstimasiKendaraan::route('/create'),
            'view' => Pages\ViewEstimasiKendaraan::route('/{record}'),
            'edit' => Pages\EditEstimasiKendaraan::route('/{record}/edit'),
        ];
    }
}
