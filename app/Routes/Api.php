<?php

namespace App\Routes;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoyaltyController;

class Api
{
    public function __invoke()
    {
        Route::middleware('api')
            ->prefix('api')
            ->group(function () {
                Route::get('/loyalty-points', [LoyaltyController::class, 'getPoints']);
            });
    }
}
