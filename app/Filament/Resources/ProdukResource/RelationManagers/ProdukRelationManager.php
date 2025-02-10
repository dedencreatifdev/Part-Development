<?php

namespace App\Filament\Resources\ProdukResource\RelationManagers;

use App\Models\Produk;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\ImageEntry;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProdukRelationManager extends RelationManager
{
    protected static string $relationship = 'relProduk';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\TextInput::make('kdbr')
                //     ->required()
                //     ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('kdbr')
            ->columns([
                Stack::make([
                    ImageColumn::make('avatar')
                        ->size('100%')
                        ->defaultImageUrl(url('https://budiberlianmotor.co.id/wp-content/uploads/logo-wa-scaled.jpg')),

                    TextColumn::make('KDBR')
                        ->label('Kode Barang')
                        ->size(TextColumn\TextColumnSize::ExtraSmall)
                        ->weight(FontWeight::Bold),
                    TextColumn::make('NAMA')
                        ->label('Nama Barang')
                        ->size(TextColumn\TextColumnSize::ExtraSmall)
                        ->limit(15),
                    TextColumn::make('KDGROUP')
                        ->prefix('Grup : ')
                        ->label('Grup')
                        ->size(TextColumn\TextColumnSize::ExtraSmall),
                    TextColumn::make('relLokasiRak.rak')
                        ->prefix('Lokasi : ')
                        ->suffix(' (Tuba)')
                        ->default('-')
                        ->size(TextColumn\TextColumnSize::ExtraSmall),
                    TextColumn::make('SATUAN')
                        ->prefix('Satuan : ')
                        ->size(TextColumn\TextColumnSize::ExtraSmall),
                    TextColumn::make('HRG_JUAL')
                        ->prefix('Rp ')
                        ->size(TextColumn\TextColumnSize::ExtraSmall)
                        ->weight(FontWeight::Bold)
                        ->numeric(),
                    TextColumn::make('KETERANGAN')
                        ->prefix('Part Rel : ')
                        ->size(TextColumn\TextColumnSize::ExtraSmall),

                ]),
            ])
            ->contentGrid([
                'default' => 2,
                'sm' => 3,
                'md' => 3,
                'lg' => 4,
                'xl' => 6,
                '2xl' => 7,
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
