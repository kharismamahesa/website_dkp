<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DipCategory extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['name'];

    // Change the method name to match what you're using in the controller
    public function dip_documents()
    {
        return $this->hasMany(DipDocument::class, 'dip_category_id');
    }
}
