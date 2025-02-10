<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EstimasiKendaraanResource\Pages;
use App\Filament\Resources\EstimasiKendaraanResource\RelationManagers;
use App\Models\EstimasiKendaraan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EstimasiKendaraanResource extends Resource
{
    protected static ?string $model = EstimasiKendaraan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('estimasi_id')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('kendaraan_id')
                    ->required()
                    ->maxLength(100),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Tables\Columns\TextColumn::make('id')
                //     ->label('ID')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('estimasi_id')
                //     ->searchable(),
                Tables\Columns\TextColumn::make('kendaraan_id')
                    ->searchable(),
                // Tables\Columns\TextColumn::make('created_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('updated_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('deleted_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
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
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // RelationManagers\EstimasiRelationManager::class,
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
