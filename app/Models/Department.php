<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'head',
        'position',
        'description',
        'profile_photo',
    ];

    public function subDepartments()
    {
        return $this->hasMany(SubDepartment::class);
    }

    protected static function booted()
    {
        static::deleting(function ($department) {
            if ($department->profile_photo && Storage::disk('public')->exists($department->profile_photo)) {
                Storage::disk('public')->delete($department->profile_photo);
            }
        });
    }
}
