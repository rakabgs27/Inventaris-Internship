<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\API\InventoryController;

Route::post('/auth/login', [AuthController::class, 'login']);
Route::group(
    ['middleware' => 'auth:sanctum'],
    function () {
        //profile
        Route::apiResource('profile', ProfileController::class)->except(['store', 'destroy']);
        Route::put('/profile', [ProfileController::class, 'update']);

        //inventory
        Route::apiResource('inventory', InventoryController::class);
    }
);
