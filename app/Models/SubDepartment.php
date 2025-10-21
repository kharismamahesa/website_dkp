<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubDepartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'name',
        'head',
        'position',
        'description',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
