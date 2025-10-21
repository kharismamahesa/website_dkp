<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HeadOfficeSettingResource\Pages;
use App\Filament\Resources\HeadOfficeSettingResource\RelationManagers;
use App\Models\HeadOfficeSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HeadOfficeSettingResource extends Resource
{
    protected static ?string $model = HeadOfficeSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    protected static ?int $navigationSort = 8;
    protected static ?string $navigationLabel = 'Pengaturan Pimpinan';
    protected static ?string $navigationGroup = 'Struktur Organisasi';

    public static function getPluralLabel(): string
    {
        return 'Pengaturan Pimpinan';
    }
    public static function getModelLabel(): string
    {
        return 'Pengaturan Pimpinan';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('position')
                    ->label('Jabatan')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nip')
                    ->label('NIP')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('photo')
                    ->label('Foto')
                    ->image()
                    ->disk('public')
                    ->directory('head_office_settings')
                    ->visibility('public')
                    ->nullable()
                    ->maxSize(1024)
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg']),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo')
                    ->label('Foto')
                    ->width('400')
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')->label('Nama')->sortable(),
                Tables\Columns\TextColumn::make('position')->label('Jabatan')->sortable(),
                Tables\Columns\TextColumn::make('nip')->label('NIP')->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->button()->label('Edit'),
                Tables\Actions\DeleteAction::make()->button()->label('Hapus'),
            ])
            ->bulkActions([
                //
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
            'index' => Pages\ListHeadOfficeSettings::route('/'),
            'create' => Pages\CreateHeadOfficeSetting::route('/create'),
            'edit' => Pages\EditHeadOfficeSetting::route('/{record}/edit'),
        ];
    }
}
