<?php

namespace App\Filament\Resources\EstimasiResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextColumn\TextColumnSize;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RelEstimasiKendaraanRelationManager extends RelationManager
{
    protected static string $relationship = 'relEstimasiKendaraan';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('kendaraan_id')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('estimasi_id')
            ->columns([
                Stack::make([

                    // TextColumn::make('estimasi_id'),
                    TextColumn::make('kendaraan_id')
                        ->size(TextColumnSize::ExtraSmall)
                        ->weight(FontWeight::Bold)
                        ->alignCenter(),
                ]),
            ])
            ->contentGrid([
                'default' => 2,
                'sm' => 3,
                'md' => 3,
                'lg' => 4,
                'xl' => 6,
                '2xl' => 8,
                '3xl' => 10,
                '4xl' => 12,
            ])

            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
