<?php

use App\Http\Controllers\Api\AdvertisementController;
use Illuminate\Support\Facades\Route;


Route::prefix('/advertisement')->group(function () {
    Route::post('', [AdvertisementController::class, 'store']);
    Route::get('', [AdvertisementController::class, 'index']);
    Route::get('/{id}', [AdvertisementController::class, 'show']);

});
