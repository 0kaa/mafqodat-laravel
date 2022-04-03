<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        /* Lost item data */
        'details',
        'image',
        'primary_colour',
        'secondary_colour',
        'tertiary_colour',
        'date',
        'time',
        'category_id',
        'station_id',
        'description',
        'storage',
        'is_delivered',

        /* User data */
        'first_name',
        'surname',
        'address',
        'secondary_address',
        'city',
        'postcode',
        'phone',
        'mobile',
        'email',
    ];

    protected $dates = [
        'date',
        'time'
    ];

    protected $casts = [
        'category_id' => 'integer',
        'station_id' => 'integer',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function station()
    {
        return $this->belongsTo(Station::class, 'station_id', 'id');
    }
}
