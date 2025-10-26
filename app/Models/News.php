<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'thumbnail',
        'status',
        'user_id',
        'publish_date'
    ];

    protected static function booted()
    {
        static::deleting(function ($news) {
            if ($news->thumbnail && Storage::disk('public')->exists($news->thumbnail)) {
                Storage::disk('public')->delete($news->thumbnail);
            }
        });
    }

    protected static function boot()
    {
        parent::boot();

        // otomatis bikin slug dari title
        static::creating(function ($news) {
            $news->slug = Str::slug($news->title);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
