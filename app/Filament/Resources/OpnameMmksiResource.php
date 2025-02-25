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
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OpnameMmksiResource extends Resource
{
    protected static ?string $model = OpnameMmksi::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('kode')
                    ->maxLength(25)
                    ->default(null),
                TextInput::make('nama')
                    ->maxLength(50)
                    ->default(null),
                TextInput::make('harga')
                    ->numeric()
                    ->default(null),
                TextInput::make('hpp')
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
                TextInput::make('status')
                    ->maxLength(20)
                    ->default(null),
                TextInput::make('cek')
                    ->numeric()
                    ->default(2),
                Toggle::make('tertukar')
                    ->onColor('success')
                    ->offColor('danger'),
                // TextInput::make('tertukar')
                //     ->required()
                //     ->numeric()
                //     ->default(0),
                TextInput::make('part_terukar')
                    ->maxLength(250)
                    ->default(null),
                TextInput::make('gudang')
                    ->maxLength(20)
                    ->default(null),
                TextInput::make('keterangan')
                    ->maxLength(100)
                    ->default(null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kode')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('harga')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('hpp')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('stok')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fisik')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('so')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sell')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('cek')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tertukar')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('part_terukar')
                    ->searchable(),
                Tables\Columns\TextColumn::make('gudang')
                    ->searchable(),
                Tables\Columns\TextColumn::make('keterangan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
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
