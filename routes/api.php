<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoyaltyController;

Route::get('/loyalty/points', [LoyaltyController::class, 'getPoints']);
Route::post('/loyalty/points', [LoyaltyController::class, 'storePoints']);
Route::get('/loyalty/points/transactions/{email}', [LoyaltyController::class, 'getTransactions']);
Route::post('/loyalty/points/redeem', [LoyaltyController::class, 'redeem']);
