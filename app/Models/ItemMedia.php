<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemMedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'media_id',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function media()
    {
        return $this->belongsTo(Media::class);
    }
}
