<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DepartmentResource\Pages;
use App\Filament\Resources\DepartmentResource\RelationManagers;
use App\Models\Department;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DepartmentResource extends Resource
{
    protected static ?string $model = Department::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-library';
    protected static ?int $navigationSort = 9;
    protected static ?string $navigationLabel = 'Bidang';
    protected static ?string $navigationGroup = 'Struktur Organisasi';

    public static function getPluralLabel(): string
    {
        return 'Daftar Bidang';
    }
    public static function getModelLabel(): string
    {
        return 'Bidang';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required()->maxLength(255),
                TextInput::make('head')->maxLength(255),
                TextInput::make('position')
                    ->label('Position')
                    ->maxLength(255),
                FileUpload::make('profile_photo')
                    ->label('Profile Photo')
                    ->image()
                    ->disk('public')
                    ->directory('departments')
                    ->visibility('public')
                    ->nullable()
                    ->maxSize(1024)
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg']),

                Textarea::make('description')->rows(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('profile_photo')
                    ->label('Profile Photo')
                    ->circular(),
                TextColumn::make('name')->label('Nama Bidang')->searchable()->sortable(),
                TextColumn::make('head')->label('Kepala')->searchable(),
                TextColumn::make('position')->label('Jabatan')->searchable(),
                TextColumn::make('description')->label('Deskripsi')->limit(50),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make()->button()->label('Edit'),
                DeleteAction::make()->button()->label('Hapus'),
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
            'index' => Pages\ListDepartments::route('/'),
            'create' => Pages\CreateDepartment::route('/create'),
            'edit' => Pages\EditDepartment::route('/{record}/edit'),
        ];
    }
}
