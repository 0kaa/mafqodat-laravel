<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
    ];

    public function getMediaImageAttribute()
    {
        return asset('storage/' . $this->image);
    }

    // public function item()
    // {
    //     return $this->belongsTo(Item::class);
    // }
}
