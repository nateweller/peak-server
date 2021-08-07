<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\LocationController;

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

Route::get('/', function() {
    return ':)';
});

// Authentication
Route::post('/register', [UserAuthController::class, 'register']);
Route::post('/login', [UserAuthController::class, 'login']);
Route::post('/forgot', [UserAuthController::class, 'forgotPassword']);
Route::post('/reset', [UserAuthController::class, 'resetPassword']);

// Organizations
Route::middleware('auth:api')->apiResource('/organizations', OrganizationController::class);

// Locations
Route::middleware('auth:api')->apiResource('/locations', LocationController::class);