<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::name('api.')->group(function () {
    Route::prefix('v1')->name('v1.')->group(base_path('routes/api_v1.php'));
});
