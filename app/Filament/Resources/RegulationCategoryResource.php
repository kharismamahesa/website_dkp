<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RegulationCategoryResource\Pages;
use App\Filament\Resources\RegulationCategoryResource\RelationManagers;
use App\Models\RegulationCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RegulationCategoryResource extends Resource
{
    protected static ?string $model = RegulationCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';
    protected static ?int $navigationSort = 5;
    protected static ?string $navigationLabel = 'Kategori Regulasi';
    protected static ?string $navigationGroup = 'Regulasi';
    public static function getPluralLabel(): string
    {
        return 'Daftar Kategori Regulasi';
    }
    public static function getModelLabel(): string
    {
        return 'Kategori Regulasi';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama Kategori')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Kategori')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make()->button()->label('Edit'),
                DeleteAction::make()->button()->label('Hapus'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRegulationCategories::route('/'),
            'create' => Pages\CreateRegulationCategory::route('/create'),
            'edit' => Pages\EditRegulationCategory::route('/{record}/edit'),
        ];
    }
}
