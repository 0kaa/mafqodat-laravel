<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\LogController;
use App\Http\Controllers\Api\ReportController;
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
    Route::post('profile/update', [AuthController::class, 'updateProfile']);
    Route::post('profile/change-password', [AuthController::class, 'changePassword']);

    /* category routes */
    Route::get('categories', [CategoryController::class, 'getAllCategories']);
    Route::post('categories/create', [CategoryController::class, 'createCategory'])->middleware(['permission:create_category']);
    Route::post('categories/update/{id}', [CategoryController::class, 'updateCategory'])->middleware(['permission:update_category']);
    Route::post('categories/delete/{id}', [CategoryController::class, 'deleteCategory'])->middleware(['permission:delete_category']);

    /* country routes */
    Route::get('countries', [CountryController::class, 'getAllcountries']);
    Route::post('countries/create', [CountryController::class, 'createCountry'])->middleware(['permission:create_country']);
    Route::post('countries/update/{id}', [CountryController::class, 'updateCountry'])->middleware(['permission:update_country']);
    Route::post('countries/delete/{id}', [CountryController::class, 'deleteCountry'])->middleware(['permission:delete_country']);

    /* city routes */
    Route::get('cities', [CityController::class, 'getAllcities']);
    Route::post('cities/create', [CityController::class, 'createCity'])->middleware(['permission:create_city']);
    Route::post('cities/update/{id}', [CityController::class, 'updateCity'])->middleware(['permission:update_city']);
    Route::post('cities/delete/{id}', [CityController::class, 'deleteCity'])->middleware(['permission:delete_city']);

    /* station routes */
    Route::get('stations', [StationController::class, 'getAllstations']);
    Route::get('stations/show/{id}', [StationController::class, 'showStation']);
    Route::post('stations/create', [StationController::class, 'createStation'])->middleware(['permission:create_station']);
    Route::post('stations/update/{id}', [StationController::class, 'updateStation'])->middleware(['permission:update_station']);
    Route::post('stations/delete/{id}', [StationController::class, 'deleteStation'])->middleware(['permission:delete_station']);

    /* employees routes */

    Route::get('employees', [EmployeeController::class, 'getAllemployees']);
    Route::get('employees/show/{id}', [EmployeeController::class, 'showEmployee']);
    Route::get('permission-list', [EmployeeController::class, 'permissionList'])->middleware(['permission:create_employee|update_employee|delete_employee']);
    Route::post('employees/create', [EmployeeController::class, 'createEmployee'])->middleware(['permission:create_employee']);
    Route::post('employees/update/{id}', [EmployeeController::class, 'updateEmployee'])->middleware(['permission:update_employee']);
    Route::post('employees/delete/{id}', [EmployeeController::class, 'deleteEmployee'])->middleware(['permission:delete_employee']);

    /* items routes */
    Route::get('items', [ItemController::class, 'getAllitems']);
    Route::get('items/show/{id}', [ItemController::class, 'showItem']);
    Route::post('items/create', [ItemController::class, 'createItem'])->middleware(['permission:create_item']);
    Route::post('items/update/{id}', [ItemController::class, 'updateItem'])->middleware(['permission:update_item']);
    Route::post('items/delete/{id}', [ItemController::class, 'deleteItem'])->middleware(['permission:delete_item']);

    /* logs routes */
    Route::get('logs', [LogController::class, 'getAllLogs']);

    /* reports routes */
    Route::get('reports/count', [ReportController::class, 'getCount']);
    Route::get('reports/latest-items', [ReportController::class, 'latestItems']);

});
