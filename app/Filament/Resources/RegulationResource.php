<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RegulationResource\Pages;
use App\Filament\Resources\RegulationResource\RelationManagers;
use App\Models\Regulation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RegulationResource extends Resource
{
    protected static ?string $model = Regulation::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?int $navigationSort = 6;
    protected static ?string $navigationLabel = 'Regulasi';
    protected static ?string $navigationGroup = 'Regulasi';
    public static function getPluralLabel(): string
    {
        return 'Daftar Regulasi';
    }
    public static function getModelLabel(): string
    {
        return 'Regulasi';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('regulation_category_id')
                    ->label('Kategori Regulasi')
                    ->relationship('category', 'name')
                    ->required(),

                Forms\Components\TextInput::make('title')
                    ->label('Judul')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi')
                    ->rows(3),

                Forms\Components\Select::make('source_type')
                    ->label('Jenis Sumber')
                    ->options([
                        'file' => 'Upload File',
                        'link' => 'Link External',
                    ])
                    ->required()
                    ->live(),

                Forms\Components\FileUpload::make('file_path')
                    ->label('File Regulasi (PDF)')
                    ->acceptedFileTypes(['application/pdf'])
                    ->directory('regulations')
                    ->disk('public')
                    ->maxSize(10240)
                    ->downloadable()
                    ->openable()
                    ->visible(fn(Forms\Get $get): bool => $get('source_type') === 'file')
                    ->required(fn(Forms\Get $get): bool => $get('source_type') === 'file'),

                Forms\Components\TextInput::make('external_link')
                    ->label('Link Dokumen')
                    ->url()
                    ->prefix('https://')
                    ->visible(fn(Forms\Get $get): bool => $get('source_type') === 'link')
                    ->required(fn(Forms\Get $get): bool => $get('source_type') === 'link')
                    ->helperText('Masukkan link yang dapat diakses publik'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Kategori Regulasi')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(50)
                    ->wrap(),

                Tables\Columns\IconColumn::make('source_type')
                    ->label('Sumber')
                    ->icon(fn(string $state): string => match ($state) {
                        'file' => 'heroicon-o-document',
                        'link' => 'heroicon-o-link',
                    })
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->button()
                    ->color('info')
                    ->label('Lihat')
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->url(
                        fn($record) => $record->source_type === 'file'
                            ? asset('storage/' . $record->file_path)
                            : $record->external_link
                    )
                    ->openUrlInNewTab(),
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
            'index' => Pages\ListRegulations::route('/'),
            'create' => Pages\CreateRegulation::route('/create'),
            'edit' => Pages\EditRegulation::route('/{record}/edit'),
        ];
    }
}
