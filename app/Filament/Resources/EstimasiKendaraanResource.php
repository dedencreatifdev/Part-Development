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
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Split;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Support\Enums\ActionSize;
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
    protected static ?string $navigationGroup = 'Estimasi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('kode_jenis')
                    ->label('Kode Jenis')
                    ->options(Kendaraan::groupByRaw('kendaraan')->pluck('kendaraan', 'kendaraan'))
                    ->searchable(),
                FileUpload::make('image')
                    ->image()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Stack::make([
                    // Columns
                    ImageColumn::make('image')
                        ->size('100%'),
                    TextColumn::make('relKendaraan.kendaraan')
                        ->size(TextColumn\TextColumnSize::ExtraSmall)
                        ->alignCenter()
                        // ->weight(FontWeight::Bold)
                        ->searchable(),
                ])
            ])
            ->contentGrid([
                'default' => 2,
                'sm' => 3,
                'md' => 3,
                'lg' => 4,
                'xl' => 5,
                '2xl' => 8,
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->size(ActionSize::ExtraSmall)
                    ->label('Lihat Detail')
                    ->icon('heroicon-o-clipboard-document-list')
                    ->color('primary'),
                Tables\Actions\EditAction::make()
                    ->size(ActionSize::ExtraSmall),
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

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                // TextEntry::make('relKendaraan.kendaraan'),
                Split::make([
                    Section::make([
                        TextEntry::make('relKendaraan.kendaraan')
                        // ->weight(FontWeight::Bold)
                        ,
                        ImageEntry::make('image')
                            // ->size('40%')
                            ->label(''),
                    ])->grow(false),
                    Section::make([
                        TextEntry::make('relKendaraan.kendaraan')
                    ]),
                ])->from('md')
            ])->columns(1);
    }
}
