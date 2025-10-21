<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class DipDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'dip_category_id',
        'name',
        'description',
        'document',
        'external_link',
        'source_type'
    ];

    public function category()
    {
        return $this->belongsTo(DipCategory::class, 'dip_category_id');
    }

    protected static function booted()
    {
        static::deleting(function ($dipDocument) {
            if ($dipDocument->document) {
                Storage::disk('public')->delete($dipDocument->document);
            }
        });
    }
}
