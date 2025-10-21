<?php

namespace App\Models;

use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegulationCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function regulations()
    {
        return $this->hasMany(Regulation::class);
    }

    protected static function booted()
    {
        static::deleting(function ($category) {
            if ($category->regulations()->exists()) {
                Notification::make()
                    ->title('Gagal Menghapus Kategori')
                    ->body('Kategori ini masih digunakan oleh data regulasi.')
                    ->danger()
                    ->send();
                return false;
            }
        });
    }
}
