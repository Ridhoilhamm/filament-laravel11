<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MejaResource\Pages;
use App\Filament\Resources\MejaResource\RelationManagers;
use App\Models\Meja;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MejaResource extends Resource
{
    protected static ?string $model = Meja::class;

    protected static ?string $navigationIcon = 'heroicon-o-queue-list';
    protected static ?string $slug = 'halaman_meja';
    protected static ?string $label = 'Data Meja';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nomer_meja'),
                Select::make('status_meja')
                    ->options([
                        'Terisi' => 'Terisi',
                        'Belum Terisi' => 'Belum Terisi',
                    ])


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nomer_meja'),
                TextColumn::make('status_meja')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
            
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
            'index' => Pages\ListMejas::route('/'),
            'create' => Pages\CreateMeja::route('/create'),
            'edit' => Pages\EditMeja::route('/{record}/edit'),
        ];
    }
}
