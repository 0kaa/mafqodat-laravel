<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\StationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* Auth routes */
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('forget-password', [AuthController::class, 'forgetPassword']);
Route::post('verify-otp', [AuthController::class, 'verifyOtp']);

Route::group(['middleware' => 'auth:sanctum', 'localization'], function () {

    /* profile routes */
    Route::get('profile', [AuthController::class, 'profile']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('set-new-password', [AuthController::class, 'setNewPassword']);

    /* category routes */
    Route::get('categories', [CategoryController::class, 'getAllCategories']);
    Route::post('categories/create', [CategoryController::class, 'createCategory']);
    Route::post('categories/update/{id}', [CategoryController::class, 'updateCategory']);
    Route::post('categories/delete/{id}', [CategoryController::class, 'deleteCategory']);

    /* country routes */
    Route::get('countries', [CountryController::class, 'getAllcountries']);
    Route::post('countries/create', [CountryController::class, 'createCountry']);
    Route::post('countries/update/{id}', [CountryController::class, 'updateCountry']);
    Route::post('countries/delete/{id}', [CountryController::class, 'deleteCountry']);

    /* city routes */
    Route::get('cities', [CityController::class, 'getAllcities']);
    Route::post('cities/create', [CityController::class, 'createCity']);
    Route::post('cities/update/{id}', [CityController::class, 'updateCity']);
    Route::post('cities/delete/{id}', [CityController::class, 'deleteCity']);

    /* station routes */
    Route::get('stations', [StationController::class, 'getAllstations']);
    Route::post('stations/create', [StationController::class, 'createStation']);
    Route::post('stations/update/{id}', [StationController::class, 'updateStation']);
    Route::post('stations/delete/{id}', [StationController::class, 'deleteStation']);

    /* employees routes */
    Route::get('employees', [EmployeeController::class, 'getAllemployees']);
    Route::post('employees/create', [EmployeeController::class, 'createEmployee']);
    Route::post('employees/update/{id}', [EmployeeController::class, 'updateEmployee']);
    Route::post('employees/delete/{id}', [EmployeeController::class, 'deleteEmployee']);

    /* items routes */
    Route::get('items', [ItemController::class, 'getAllitems']);
    Route::post('items/create', [ItemController::class, 'createItem']);
});
