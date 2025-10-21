<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DipResource\Pages;
use App\Models\DipDocument;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DipResource extends Resource
{
    protected static ?string $model = DipDocument::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?int $navigationSort = 7;
    protected static ?string $navigationLabel = 'Informasi Publik';
    protected static ?string $navigationGroup = 'Regulasi';
    public static function getPluralLabel(): string
    {
        return 'Daftar Informasi Publik';
    }
    public static function getModelLabel(): string
    {
        return 'Informasi Publik';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('dip_category_id')
                    ->label('Kategori Informasi Publik')
                    ->relationship('category', 'name')
                    ->required(),

                Forms\Components\TextInput::make('name')
                    ->label('Nama Dokumen')
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

                Forms\Components\FileUpload::make('document')
                    ->label('File Dokumen (PDF)')
                    ->acceptedFileTypes(['application/pdf'])
                    ->directory('dip_documents') // disimpan di storage/app/public/dip_documents
                    ->disk('public')
                    ->maxSize(10240) // 10 MB
                    ->downloadable()
                    ->visible(fn(Forms\Get $get): bool => $get('source_type') === 'file')
                    ->required(fn(Forms\Get $get): bool => $get('source_type') === 'file'),

                Forms\Components\TextInput::make('external_link')
                    ->label('Link Dokumen')
                    ->url()
                    ->prefix('https://')
                    ->visible(fn(Forms\Get $get): bool => $get('source_type') === 'link')
                    ->required(fn(Forms\Get $get): bool => $get('source_type') === 'link'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Kategori')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color(fn($record): string => match ($record->category->name) {
                        'Berkala' => 'success',
                        'Serta Merta' => 'warning',
                        'Tersedia Setiap Saat' => 'info',
                        'Dikecualikan' => 'danger',
                        default => 'secondary',
                    }),
                Tables\Columns\TextColumn::make('name')->label('Nama Dokumen')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('description')->label('Deskripsi')->limit(50),
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
                            ? asset('storage/' . $record->document)
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
            'index' => Pages\ListDips::route('/'),
            'create' => Pages\CreateDip::route('/create'),
            'edit' => Pages\EditDip::route('/{record}/edit'),
        ];
    }
}
