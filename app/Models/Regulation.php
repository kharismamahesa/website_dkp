<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Regulation extends Model
{
    use HasFactory;

    protected $fillable = [
        'regulation_category_id',
        'title',
        'description',
        'file_path',
        'external_link',
        'source_type'
    ];

    public function category()
    {
        return $this->belongsTo(RegulationCategory::class, 'regulation_category_id');
    }

    protected static function booted()
    {
        static::deleting(function ($regulation) {
            if ($regulation->file_path) {
                Storage::disk('public')->delete($regulation->file_path);
            }
        });
    }
}
