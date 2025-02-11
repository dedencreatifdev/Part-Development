<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PelangganResource\Pages;
use App\Filament\Resources\PelangganResource\RelationManagers;
use App\Models\Pelanggan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PelangganResource extends Resource
{
    protected static ?string $model = Pelanggan::class;

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Master Data';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_customer')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('alamat')
                    ->required()
                    ->maxLength(200),
                Forms\Components\TextInput::make('no_telp')
                    ->tel()
                    ->required()
                    ->maxLength(20),
                Forms\Components\TextInput::make('no_polisi')
                    ->maxLength(10)
                    ->default(null),
                Forms\Components\TextInput::make('no_wo')
                    ->maxLength(20)
                    ->default(null),
                Forms\Components\TextInput::make('type_kendaraan')
                    ->required()
                    ->maxLength(200),
                Forms\Components\TextInput::make('no_chasis')
                    ->required()
                    ->maxLength(250),
                Forms\Components\TextInput::make('no_mesin')
                    ->required()
                    ->maxLength(200),
            ])
            ->columns(4);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('no_polisi')
                    // ->size(TextColumn\TextColumnSize::ExtraSmall)
                    ->searchable(),
                TextColumn::make('nama_customer')
                    // ->size(TextColumn\TextColumnSize::ExtraSmall)
                    ->searchable(),
                TextColumn::make('alamat')
                ->wrap()
                    // ->size(TextColumn\TextColumnSize::ExtraSmall)
                    ->searchable(),
                TextColumn::make('no_telp')
                    // ->size(TextColumn\TextColumnSize::ExtraSmall)
                    ->searchable(),
                TextColumn::make('no_wo')
                    ->visibleOn('md')
                    // ->size(TextColumn\TextColumnSize::ExtraSmall)
                    ->searchable(),
                TextColumn::make('type_kendaraan')
                    // ->size(TextColumn\TextColumnSize::ExtraSmall)
                    ->searchable(),
                TextColumn::make('no_chasis')
                    ->searchable()
                    ->visibleOn('md'),
                TextColumn::make('no_mesin')
                    ->searchable()
                    ->visibleOn('md'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),

                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListPelanggans::route('/'),
            'create' => Pages\CreatePelanggan::route('/create'),
            'view' => Pages\ViewPelanggan::route('/{record}'),
            'edit' => Pages\EditPelanggan::route('/{record}/edit'),
        ];
    }
}
