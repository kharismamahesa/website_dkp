<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ComplaintResource\Pages;
use App\Models\Complaint;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Form;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\FilterForm;
use Filament\Forms\Components\DatePicker;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Label;

class ComplaintResource extends Resource
{
    protected static ?string $model = Complaint::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?int $navigationSort = 11;
    protected static ?string $navigationLabel = 'Pengaduan Masyarakat';
    protected static ?string $navigationGroup = 'Pengaduan';

    public static function getPluralLabel(): string
    {
        return 'Daftar Pengaduan Masyarakat';
    }

    public static function getModelLabel(): string
    {
        return 'Pengaduan Masyarakat';
    }

    public static function getNavigationBadge(): ?string
    {
        $count = Complaint::where('status', 'pending')->count();
        return $count > 0 ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'success';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nama')
                    ->disabled()
                    ->dehydrated(false),
                TextInput::make('email')
                    ->label('Email')
                    ->disabled()
                    ->dehydrated(false),
                Textarea::make('message')
                    ->label('Pesan')
                    ->disabled()
                    ->columnSpanFull()
                    ->dehydrated(false),
                Textarea::make('response')
                    ->label('Tanggapan')
                    ->placeholder('Tulis tanggapan di sini...')
                    ->columnSpanFull(),
                TextInput::make('status')
                    ->label('Status')
                    ->default(fn($record) => strtoupper($record->status))
                    ->disabled()
                    ->dehydrated(false)
                    ->extraAttributes(fn($record) => [
                        'style' => $record->status === 'resolved'
                            ? 'color: rgb(22 163 74); border: 2px solid rgb(22 163 74); border-radius: 0.375rem; padding: 0.5rem 1rem; text-align: center; font-weight: 500; text-transform: uppercase;'  // success outline
                            : 'color: rgb(234 179 8); border: 2px solid rgb(234 179 8); border-radius: 0.375rem; padding: 0.5rem 1rem; text-align: center; font-weight: 500; text-transform: uppercase;'   // warning outline
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('message')
                    ->label('Pesan')
                    ->limit(50)
                    ->sortable()
                    ->searchable()
                    ->tooltip(fn($state) => strlen($state) > 50 ? $state : null),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->sortable()
                    ->searchable()
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'resolved',
                    ]),
                TextColumn::make('updated_at')
                    ->label('Diperbarui Pada')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('from')
                            ->label('Dari Tanggal'),
                        DatePicker::make('until')
                            ->label('Sampai Tanggal'),
                    ])
                    ->query(function ($query, array $data): void {
                        $query
                            ->when(
                                $data['from'],
                                fn($query, $date): mixed => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['until'],
                                fn($query, $date): mixed => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['from'] ?? null) {
                            $indicators['from'] = 'Dari ' . Carbon::parse($data['from'])->format('d M Y');
                        }
                        if ($data['until'] ?? null) {
                            $indicators['until'] = 'Sampai ' . Carbon::parse($data['until'])->format('d M Y');
                        }
                        return $indicators;
                    }),
            ])
            ->actions([
                EditAction::make()
                    ->label('Tanggapi')
                    ->button(),
                DeleteAction::make()
                    ->label('Hapus')
                    ->button()
                    ->visible(fn() => auth()->user()?->role === 'super_admin'),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListComplaints::route('/'),
            'edit' => Pages\EditComplaint::route('/{record}/edit'),
        ];
    }
}
