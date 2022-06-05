<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name_ar', 'name_en', 'image', 'slug', 'storage_id'];

    public function getNameAttribute()
    {
        return $this->{'name_' . App::getLocale()};
    }

    protected function rules()
    {
        return [
            'name_ar'    => 'required',
            'name_en'    => 'required',
            'image'      => 'sometimes',
            'storage_id' => 'required',
        ];
    }

    public function storage()
    {
        return $this->belongsTo(Storage::class);
    }

}
