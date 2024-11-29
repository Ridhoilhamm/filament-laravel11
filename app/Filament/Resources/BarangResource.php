<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BarangResource\Pages;
use App\Filament\Resources\BarangResource\RelationManagers;
use App\Models\Barang;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BarangResource extends Resource
{
    protected static ?string $model = Barang::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?string $slug = 'halaman-barang';
    protected static ?string $label = 'Data Barang';
    

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_barang')->label('Nama')->placeholder('Masukan Nama Barang')->required(),
                TextInput::make('kode_barang')->label('Kode Barang')->placeholder('Masukkan Kode Barang')->required(),
                TextInput::make('harga_barang')->label('Harga Barang')->placeholder('Masukkan Harga Barang')->numeric()
                ->required()->minValue(1)->columnSpan(2),
                FileUpload::make('image')->label('Image')->directory('barangs')
                    ->image()
                    ->columnSpan(2)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_barang')->searchable(),
                TextColumn::make('kode_barang')->searchable(),
                TextColumn::make('harga_barang')->searchable(),
                ImageColumn::make('image')->disk('public')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListBarangs::route('/'),
            'create' => Pages\CreateBarang::route('/create'),
            'edit' => Pages\EditBarang::route('/{record}/edit'),
        ];
    }
}
