<?php

namespace App\Filament\Resources\ComplaintResource\Pages;

use App\Filament\Resources\ComplaintResource;
use App\Mail\ComplaintMail;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Mail;

class EditComplaint extends EditRecord
{
    protected static string $resource = ComplaintResource::class;

    // 🧭 Judul & breadcrumb
    public function getTitle(): string
    {
        return 'Tanggapi Pengaduan Masyarakat';
    }

    public function getBreadcrumb(): string
    {
        return 'Tanggapi Pengaduan';
    }

    /**
     * 🔄 Override beforeSave agar data hanya tersimpan jika email berhasil terkirim
     */
    protected function beforeSave(): void
    {
        $complaint = $this->record;
        $response = $this->data['response'] ?? null;
        $email = $complaint->email;

        // Validasi jika resolved, tidak perlu balas lagi
        if ($complaint->status === 'resolved') {
            Notification::make()
                ->title('Pengaduan sudah ditandai sebagai selesai')
                ->body('Tidak perlu mengirim tanggapan lagi.')
                ->warning()
                ->send();
            $this->halt(); // hentikan proses simpan
        }

        // Validasi tanggapan
        if (empty($response)) {
            Notification::make()
                ->title('Tanggapan tidak boleh kosong')
                ->danger()
                ->send();
            $this->halt(); // stop proses simpan
        }

        // Validasi email
        if (empty($email)) {
            Notification::make()
                ->title('Email penerima tidak ditemukan')
                ->danger()
                ->send();
            $this->halt();
        }

        try {
            // Kirim email tanggapan terlebih dahulu
            Mail::to($email)->send(
                new ComplaintMail(
                    $response,          // Tanggapan admin
                    $complaint->message // Pesan asli dari pengguna
                )
            );

            // ✅ Jika berhasil kirim email → baru ubah status
            $this->data['status'] = 'resolved';
        } catch (\Exception $e) {
            // ❌ Email gagal dikirim → hentikan penyimpanan
            Notification::make()
                ->title('Gagal mengirim email')
                ->body($e->getMessage())
                ->danger()
                ->send();

            $this->halt(); // hentikan proses simpan agar data tidak berubah
        }
    }

    /**
     * 🔔 Notifikasi sukses setelah tersimpan
     */
    protected function afterSave(): void
    {
        Notification::make()
            ->title('Tanggapan berhasil dikirim dan data disimpan')
            ->success()
            ->send();
    }

    public static function canDelete($record): bool
    {
        return auth()->user()?->role === 'super_admin';
    }
}
