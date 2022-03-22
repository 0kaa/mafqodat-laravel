<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'name',
        'details',
        'number',
        'description',
        'location',
        'lat',
        'lng',
    ];
}
