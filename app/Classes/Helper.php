<?php

use App\Jobs\SendMultiMail;
use App\Mail\SendMailMarkting;
// use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Facades\Mail;
use App\Mail\WeHelp;
use App\Models\Notification;
use App\Servicies\Notify;
use Carbon\Carbon;
use AmrShawky\LaravelCurrency\Facade\Currency;
use App\Jobs\SendEmailGifts;
use App\Jobs\sendMailSubscribe;
use App\Mail\BondMail;
use App\Models\Log;
use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Date;

/*curr
|--------------------------------------------------------------------------
| Detect Active Routes Function
|--------------------------------------------------------------------------
|
| Compare given routes with current route and return output if they match.
| Very useful for navigation, marking if the link is active.
|
*/

function isActiveRoute($route, $output = "active")
{
    if (\Route::currentRouteName() == $route) return $output;
}

function areActiveRoutes(array $routes, $output = "active show-sub")
{

    foreach ($routes as $route) {
        if (\Route::currentRouteName() == $route) return $output;
    }
}

function areActiveMainRoutes(array $routes, $output = "active")
{

    foreach ($routes as $route) {
        if (\Route::currentRouteName() == $route) return $output;
    }
}

function getSitting($key, $lang = null)
{

    $sittingrepository =  App::make('App\Repositories\Contract\SettingRepositoryInterface');

    if ($lang == null) {

        $setting = $sittingrepository->getWhere([['key', $key]])->first();
    } else {

        $setting = $sittingrepository->getWhere([['key', $key . '_' . $lang]])->first();
    }

    return $setting;
}
