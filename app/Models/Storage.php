<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Storage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_ar', 'name_en', 'category_id'
    ];

    public function getNameAttribute()
    {
        return $this->{'name_' . App::getLocale()};
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
