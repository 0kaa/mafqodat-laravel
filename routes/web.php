<?php

use App\Http\Controllers\Dashboard\AuthController;
use App\Http\Controllers\Dashboard\EmployeeController;
use App\Http\Controllers\Dashboard\ItemController;
use App\Http\Controllers\Dashboard\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->namespace('Dashboard')->group(function () {

    /* Auth Routes */
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AuthController::class, 'login'])->name('admin.login.post');
    Route::get('logout', [AuthController::class, 'logout'])->name('admin.logout');
    Route::get('reset-password', [AuthController::class, 'reset'])->name('admin.reset');
    Route::post('send-link', [AuthController::class, 'sendLink'])->name('admin.sendLink');
    Route::get('changePassword/{code}', [AuthController::class, 'changePassword'])->name('admin.changePassword');
    Route::post('update-password', [AuthController::class, 'updatePassword'])->name('admin.updatePassword');

});


Route::get('language/{locale}', function ($locale) {

    app()->setLocale($locale);

    session()->put('locale', $locale);

    return redirect()->back();
})->name('language');


Route::prefix('admin')->middleware(['auth', 'webLocalization', 'role:super_admin'])->namespace('Dashboard')->name('admin.')->group(function () {

    Route::get('/', 'HomeController@home')->name('home');

    Route::resource('employees', 'EmployeeController');

    Route::resource('countries', 'CountryController');

    Route::resource('cities', 'CityController');

    Route::post('get-cities', [EmployeeController::class, 'getCities'])->name('get_cities');

    Route::resource('categories', 'CategoryController');

    Route::resource('stations', 'StationController');

    Route::resource('items', 'ItemController');

    Route::get('remove-session', [ItemController::class, 'removeSession'])->name('remove_session');

    Route::get('get-stations', [ItemController::class, 'getStations'])->name('get_stations');

    Route::get('profile', [UserController::class, 'getProfile'])->name('get_profile');

    Route::post('update-profile', [UserController::class, 'updateProfile'])->name('update_profile');

});
