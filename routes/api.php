<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\CountryController;
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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('forget-password', [AuthController::class, 'forgetPassword']);
Route::post('verify-otp', [AuthController::class, 'verifyOtp']);
Route::group(['middleware' => 'auth:sanctum', 'localization'], function () {

    Route::get('profile', [AuthController::class, 'profile']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('set-new-password', [AuthController::class, 'setNewPassword']);

    Route::get('categories', [CategoryController::class, 'getAllCategories']);
    Route::post('categories/create', [CategoryController::class, 'createCategory']);
    Route::post('categories/update/{id}', [CategoryController::class, 'updateCategory']);
    Route::post('categories/delete/{id}', [CategoryController::class, 'deleteCategory']);

    Route::get('countries', [CountryController::class, 'getAllcountries']);
    Route::post('countries/create', [CountryController::class, 'createCountry']);
    Route::post('countries/update/{id}', [CountryController::class, 'updateCountry']);
    Route::post('countries/delete/{id}', [CountryController::class, 'deleteCountry']);

    Route::get('cities', [CityController::class, 'getAllcities']);
    Route::post('cities/create', [CityController::class, 'createCity']);
    Route::post('cities/update/{id}', [CityController::class, 'updateCity']);
    Route::post('cities/delete/{id}', [CityController::class, 'deleteCity']);
});
