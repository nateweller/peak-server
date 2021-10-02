<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ClimbController;
use App\Http\Controllers\ClimbSendController;
use App\Http\Controllers\GradingSystemController;
use App\Http\Controllers\GradingGradeController;
use App\Http\Controllers\ClimbColorController;
use App\Http\Controllers\WallController;
use App\Http\Controllers\SetController;

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

Route::middleware('auth:api')->get('/user', function(Request $request) {
    return $request->user();
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

// Walls
Route::middleware('auth:api')->apiResource('/walls', WallController::class);

// Sets
Route::middleware('auth:api')->apiResource('/sets', SetController::class);

// Climbs
Route::apiResource('/climbs', ClimbController::class);

// Sends
Route::middleware('auth:api')->apiResource('/sends', ClimbSendController::class);

// Grading
Route::middleware('auth:api')->apiResource('/grading_systems', GradingSystemController::class);
Route::middleware('auth:api')->apiResource('/grading_grades', GradingGradeController::class);

// Colors
Route::middleware('auth:api')->apiResource('/climb_colors', ClimbColorController::class);