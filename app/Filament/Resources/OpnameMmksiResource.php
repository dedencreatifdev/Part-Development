<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OpnameMmksiResource\Pages;
use App\Filament\Resources\OpnameMmksiResource\RelationManagers;
use App\Models\OpnameMmksi;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OpnameMmksiResource extends Resource
{
    protected static ?string $model = OpnameMmksi::class;

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Opname MMKSI';
    protected static ?string $navigationGroup = 'Sparepart';
    // protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('kode')
                    ->disabledOn('edit')
                    ->maxLength(25)
                    ->default(null),
                TextInput::make('nama')
                    ->disabledOn('edit')
                    ->maxLength(50)
                    ->default(null),
                TextInput::make('harga')
                    ->disabledOn('edit')
                    ->numeric()
                    ->default(null),
                TextInput::make('hpp')
                    ->disabledOn('edit')
                    ->numeric()
                    ->default(null),
                TextInput::make('stok')
                    ->numeric()
                    ->default(0),
                TextInput::make('fisik')
                    ->numeric()
                    ->default(0),
                TextInput::make('so')
                    ->numeric()
                    ->default(0),
                TextInput::make('sell')
                    ->numeric()
                    ->default(2),
                Toggle::make('tertukar')
                    ->onColor('success')
                    ->offColor('danger'),
                TextInput::make('part_terukar')
                    ->maxLength(250)
                    ->default(null),
                TextInput::make('gudang')
                    ->maxLength(20)
                    ->default(null),
                TextInput::make('keterangan')
                    ->maxLength(100)
                    ->default(null),
            ])
            ->inlineLabel()
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode')
                    ->searchable(),
                TextColumn::make('nama')
                    // ->wrap()
                    ->searchable(),
                TextColumn::make('harga')
                    ->alignEnd()
                    ->visibleFrom('sm')
                    ->numeric(decimalPlaces: 0),
                TextColumn::make('hpp')
                    ->alignEnd()
                    ->visibleFrom('sm')
                    ->numeric(decimalPlaces: 0),
                TextColumn::make('stok')
                    ->numeric(),
                TextColumn::make('fisik')
                    ->numeric(),
                TextColumn::make('so')
                    ->numeric(),
                TextColumn::make('sell')
                    ->numeric(),
                TextColumn::make('gudang')
                    ->visibleFrom('sm')
                    ->searchable(),
            ])
            ->striped()
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListOpnameMmksis::route('/'),
            'create' => Pages\CreateOpnameMmksi::route('/create'),
            'edit' => Pages\EditOpnameMmksi::route('/{record}/edit'),
        ];
    }
}
