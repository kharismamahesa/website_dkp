<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubDepartmentResource\Pages;
use App\Filament\Resources\SubDepartmentResource\RelationManagers;
use App\Models\Department;
use App\Models\SubDepartment;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SubDepartmentResource extends Resource
{
    protected static ?string $model = SubDepartment::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';
    protected static ?int $navigationSort = 10;
    protected static ?string $navigationLabel = 'Sub Bidang';
    protected static ?string $navigationGroup = 'Struktur Organisasi';

    public static function getPluralLabel(): string
    {
        return 'Daftar Sub Bidang';
    }
    public static function getModelLabel(): string
    {
        return 'Sub Bidang';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('department_id')
                    ->label('Nama Bidang')
                    ->options(Department::pluck('name', 'id'))
                    ->required(),
                TextInput::make('name')
                    ->label('Nama Sub Bidang')
                    ->required(),
                TextInput::make('head')
                    ->label('Kepala Sub Bidang')
                    ->nullable(),
                TextInput::make('position')
                    ->label('Jabatan')
                    ->nullable(),
                Textarea::make('description')
                    ->label('Deskripsi')
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('department.name')->label('Nama Bidang')->sortable(),
                TextColumn::make('name')->label('Nama Sub Bidang')->sortable(),
                TextColumn::make('head')->label('Kepala')->sortable(),
                TextColumn::make('position')->label('Jabatan')->sortable(),
            ])
            ->defaultSort('department.name')
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
            'index' => Pages\ListSubDepartments::route('/'),
            'create' => Pages\CreateSubDepartment::route('/create'),
            'edit' => Pages\EditSubDepartment::route('/{record}/edit'),
        ];
    }
}
