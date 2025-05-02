<?php

use Illuminate\Support\Facades\Route;
use App\Routes\Api;

Route::get('/', function () {
    return view('welcome');
});

// Execute API routes
(new Api())();
