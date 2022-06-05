<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'job_number',
        'working_period',
        'date_of_hiring',
        'email',
        'password',
        'code',
        'image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = [
        'date_of_hiring',
    ];

    protected function rules()
    {
        return [
            'name'     => 'required|min:3',
            'email'          => 'required|unique:users,email' . $this->id,
            'password'       => 'required|min:6',
            'phone'          => 'required|min:8|max:12',
            'job_number'     => 'required',
        ];
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function logs()
    {
        return $this->hasMany(Log::class, 'user_id', 'id')->orderBy('created_at', 'desc');
    }
}
