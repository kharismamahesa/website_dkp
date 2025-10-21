<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AgendaResource\Pages;
use App\Filament\Resources\AgendaResource\RelationManagers;
use App\Models\Agenda;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class AgendaResource extends Resource
{
    protected static ?string $model = Agenda::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?int $navigationSort = 4;
    protected static ?string $navigationLabel = 'Agenda';
    protected static ?string $navigationGroup = 'Manajemen';
    public static function getPluralLabel(): string
    {
        return 'Daftar Agenda';
    }
    public static function getModelLabel(): string
    {
        return 'Agenda';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label('Judul')
                    ->required(),

                Textarea::make('description')
                    ->label('Deskripsi')
                    ->required()
                    ->rows(3),

                DatePicker::make('date')
                    ->label('Tanggal')
                    ->required(),

                TimePicker::make('time')
                    ->label('Waktu')
                    ->required(),

                TextInput::make('location')
                    ->label('Lokasi')
                    ->required(),

                TextInput::make('attire')
                    ->label('Pakaian')
                    ->required(),

                Textarea::make('officials')
                    ->label('Dihadiri Oleh')
                    ->required()
                    ->rows(3),

                Toggle::make('status')
                    ->label('Active')
                    ->default(true)
                // ->onColor('success')
                // ->offColor('danger')
                ,
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('description')
                    ->label('Deskripsi')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('date')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('time')
                    ->label('Waktu'),

                TextColumn::make('location')
                    ->label('Lokasi')
                    ->limit(25),

                TextColumn::make('attire')
                    ->label('Pakaian'),

                ToggleColumn::make('status')
                    ->label('Aktif'),
            ])
            ->defaultSort('date', 'desc')
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
            'index' => Pages\ListAgendas::route('/'),
            'create' => Pages\CreateAgenda::route('/create'),
            'edit' => Pages\EditAgenda::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()
            ->orderByDesc('date');
    }
}
