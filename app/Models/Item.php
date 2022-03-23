<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'details',
        'location',
        'lat',
        'lng',
        'image',
        'date',
        'time',
        'category_id',
        'station_id',
        'description',
        'storage',
    ];

    protected $dates = [
        'date',
        'time'
    ];

    protected $casts = [
        'category_id' => 'integer',
        'station_id' => 'integer',
    ];


    // public function getDateAttribute($value)
    // {
    //     $this->attributes['date'] = Carbon::parse($value)->format('yyyy-mm-dd');
    // }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function station()
    {
        return $this->belongsTo(Station::class, 'station_id', 'id');
    }
}
