<?php

namespace App\Filament\Widgets;

use App\Models\Complaint;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

/**
 * Widget untuk menampilkan grafik statistik pengaduan
 * Extends ChartWidget dari Filament untuk membuat grafik
 */
class ComplaintsChart extends ChartWidget
{
    // Judul yang akan ditampilkan di atas grafik
    protected static ?string $heading = 'Statistik Pengaduan';

    // Mengatur lebar widget menjadi full width
    protected int | string | array $columnSpan = 'full';

    protected static ?string $maxHeight = '300px';

    // Variable untuk menyimpan filter tahun yang dipilih
    public ?string $filter = null;

    // Mengatur urutan widget (angka lebih besar = posisi lebih bawah)
    protected static ?int $sort = 2;

    /**
     * Method utama untuk menyiapkan data yang akan ditampilkan di grafik
     * Returns array berisi datasets dan labels untuk grafik
     */
    protected function getData(): array
    {
        // Mengambil tahun aktif dari filter, atau tahun sekarang jika tidak ada filter
        $activeYear = $this->filter ?? Carbon::now()->year;

        // Query untuk mengambil jumlah pengaduan per bulan
        // Menggunakan selectRaw untuk mengambil bulan dan total
        $complaints = Complaint::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', $activeYear)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Debug: mencatat data ke log untuk keperluan troubleshooting
        Log::info('Year: ' . $activeYear);
        Log::info('Complaints:', $complaints->toArray());

        // Inisialisasi array dengan 12 bulan (nilai 0)
        $data = array_fill(0, 12, 0);

        // Mengisi data aktual ke array berdasarkan hasil query
        foreach ($complaints as $complaint) {
            $data[$complaint->month - 1] = $complaint->total;
        }

        // Label untuk sumbu X (nama-nama bulan)
        $labels = [
            'Januari',
            'Februar',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];

        // Mengembalikan array terformat untuk grafik
        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Pengaduan',
                    'data' => $data,
                ],
            ],
            'labels' => $labels,
        ];
    }

    /**
     * Menentukan tipe grafik yang akan digunakan
     * Returns string 'bar' untuk grafik batang
     */
    protected function getType(): string
    {
        return 'bar';
    }

    /**
     * Menyiapkan opsi filter tahun
     * Returns array berisi pilihan tahun sekarang dan tahun sebelumnya
     */
    protected function getFilters(): ?array
    {
        return [
            'current' => 'Tahun ' . Carbon::now()->year,
            'last' => 'Tahun ' . Carbon::now()->subYear()->year,
        ];
    }
}
