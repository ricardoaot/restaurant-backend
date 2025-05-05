<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoyaltyController;

Route::get('/loyalty-points', [LoyaltyController::class, 'getPoints']);
Route::post('/loyalty-points', [LoyaltyController::class, 'storePoints']);
Route::get('/loyalty-transactions/{email}', [LoyaltyController::class, 'getTransactions']);
