<?php

namespace App\Filament\Widgets;

use App\Models\Complaint;
use App\Models\Gallery;
use App\Models\News;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Jumlah Berita', News::count())
                ->description('Total berita yang dipublikasikan')
                ->color('success')
                ->icon('heroicon-o-newspaper'),
            Stat::make('Jumlah Galeri', Gallery::count())
                ->description('Total galeri foto')
                ->color('info')
                ->icon('heroicon-o-photo'),
            Stat::make('Jumlah User', User::count())
                ->description('Total akun terdaftar')
                ->color('warning')
                ->icon('heroicon-o-users'),
            Stat::make('Jumlah Pengaduan', Complaint::count())
                ->description('Total pengaduan masyarakat')
                ->color('danger')
                ->icon('heroicon-o-chat-bubble-left-right'),
            Stat::make('Jumlah Pengaduan Telah Dijawab', Complaint::where('status', 'resolved')->count())
                ->description('Total pengaduan yang telah dijawab')
                ->color('primary')
                ->icon('heroicon-o-check-circle'),
        ];
    }
}
