<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Log extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'message_ar',
        'message_en',
        'date',
    ];

    public function getMessageAttribute()
    {
        return $this->{'message_'.App::getLocale()};
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getDateAttribute($date){

        $dateFromat = Carbon::createFromFormat('Y-m-d H:i:s', $date);

        // Get the current app locale
        $locale = app()->getLocale();

        // Tell Carbon to use the current app locale
        Carbon::setlocale($locale);

        /**
         * Set the date format you'd like to use.
         * Here, I use two different formats depending on current app locale.
         *
         * For Example: `D, M j, Y H:i:s` outputs `mer., oct. 21, 2020 15:11:07`,
         *  and `D, M j, Y g:i A` outputs `mer., oct. 21, 2020 3:26 PM`
         * If you have a look at the below function 👇🏻 in the Carbon source code,
         * you'll see it uses the first format mentioned above.
         *
         * @see \Carbon\Traits\Converter::toDayDateTimeString()
         */
        $format = $locale === 'ar' ? 'l jS \\من F Y | h:i A' : 'l jS \\of F Y | h:i A';

        // Use `translatedFormat()` to get a translated date string
        return $dateFromat->translatedFormat($format);

    }

}
