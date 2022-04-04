<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Station extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'name_ar',
        'name_en',
        'details',
        'number',
        'description',
        'location',
        'lat',
        'lng',
    ];

    public function getNameAttribute()
    {
        return $this->{'name_'.App::getLocale()};
    }
}
