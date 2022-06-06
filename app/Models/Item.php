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
        'report_type',
        'report_number',
        'details',
        'date',
        'time',
        'category_id',
        'station_id',
        'description',
        'type',
        'cost',
        'storage_id',
        'is_delivered',
        'user_id',

        /* informer data */
        'informer_name',
        'informer_phone',

        /* User data */
        'first_name',
        'surname',
        'address',
        'secondary_address',
        'city_id',
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
        'storage_id' => 'integer',
        'user_id' => 'integer',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function station()
    {
        return $this->belongsTo(Station::class, 'station_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function storage()
    {
        return $this->belongsTo(Storage::class, 'storage_id', 'id');
    }

    public function itemMedia()
    {
        return $this->hasMany(ItemMedia::class, 'item_id', 'id');
    }
}
