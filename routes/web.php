<?php

use App\Http\Controllers\Dashboard\AuthController;
use App\Http\Controllers\Dashboard\EmployeeController;
use App\Http\Controllers\Dashboard\ItemController;
use App\Http\Controllers\Dashboard\LogController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::prefix('admin')->middleware(['webLocalization'])->namespace('Dashboard')->group(function () {

    /* Auth Routes */
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AuthController::class, 'login'])->name('admin.login.post');
    Route::get('reset-password', [AuthController::class, 'reset'])->name('admin.reset');
    Route::post('send-link', [AuthController::class, 'sendLink'])->name('admin.sendLink');
    Route::get('changePassword/{code}', [AuthController::class, 'changePassword'])->name('admin.changePassword');
    Route::post('update-password', [AuthController::class, 'updatePassword'])->name('admin.updatePassword');

    Route::get('not-authoried', [AuthController::class, 'notAuthorized'])->name('admin.notAuthoried');

});

Route::get('language/{locale}', function ($locale) {

    app()->setLocale($locale);

    session()->put('locale', $locale);

    return redirect()->back();
})->name('language');


Route::prefix('admin')->middleware(['auth', 'webLocalization', 'role:super_admin'])->namespace('Dashboard')->name('admin.')->group(function () {

    Route::get('/', 'HomeController@home')->name('home');

    Route::get('reports', 'HomeController@reports')->name('reports');

    Route::resource('employees', 'EmployeeController');

    Route::resource('cities', 'CityController');

    Route::resource('categories', 'CategoryController');

    Route::resource('storages', 'StorageController');

    Route::post('get-storages', 'ItemController@getStorages')->name('get_storages');

    Route::resource('stations', 'StationController');

    Route::resource('items', 'ItemController');

    Route::get('remove-image', 'ItemController@removeImage')->name('remove.image');

    Route::get('remove-session', [ItemController::class, 'removeSession'])->name('remove_session');

    Route::get('get-stations', [ItemController::class, 'getStations'])->name('get_stations');

    Route::get('profile', [UserController::class, 'getProfile'])->name('get_profile');

    Route::post('update-profile', [UserController::class, 'updateProfile'])->name('update_profile');

    Route::get('logs', [LogController::class, 'index'])->name('get_logs');

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});
