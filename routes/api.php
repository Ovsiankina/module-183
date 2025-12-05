<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KidsController;
use App\Http\Controllers\TokensController;
use App\Http\Middleware\LogTokenUsage;
use Illuminate\Support\Facades\Route;

/*
 |--------------------------------------------------------------------------
 | API Routes
 |--------------------------------------------------------------------------
 |
 | Here is where you can register API routes for your application. These
 | routes are loaded by the RouteServiceProvider and all of them will
 | be assigned to the "api" middleware group. Make something great!
 |
 */

// Pour afficher toutes les routes : php artisan route:list

Route::prefix("kids")->group(function () {
    // NOTE(ex 4): Add `-->middleware(/* ... */)` to get routes
    Route::get("", [KidsController::class, "index"])->middleware('auth:sanctum');;
    Route::get("{kid}", [KidsController::class, "show"])->middleware('auth:sanctum');;
    // NOTE(ex 4): Remove `-->middleware(/* ... */)` from post route to allow everyone
    // Route::post("store", [KidsController::class, "store"]); // Wrong: non-REST URL; kept for comparison
    Route::post("", [KidsController::class, "store"]);
    Route::patch("{kid}", [KidsController::class, "update"])->middleware('auth:sanctum');
    Route::delete("{kid}", [KidsController::class, "destroy"])->middleware('auth:sanctum');
});

Route::middleware(['auth:sanctum', 'ability:*'])->group(function () {
    Route::apiResources([
        "tokens" => TokensController::class,
    ]);
});

Route::prefix("auth")->group(function () {
    Route::post("login", [AuthController::class, "login"]);
    Route::middleware('auth:sanctum')->group(function () {
        Route::post("logout", [AuthController::class, "logout"]);
    });
});
