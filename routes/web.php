
<?php

use App\Http\Controllers\BranchController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ScheduleController;
use App\Http\Middleware\IsOwner;
use App\Models\City;
use App\Models\User\Role;
use DebugBar\DebugBar;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule.index');


    Route::middleware(IsOwner::class)->group(function () {  
        Route::resource('businesses', BusinessController::class);
        Route::resource('branches', BranchController::class)->except('index');
        Route::resource('positions', PositionController::class);
        Route::resource('employees', EmployeeController::class);
    });

    Route::name('owner.')->group(function () {
        Route::post('/becomeOwner', [OwnerController::class, 'becomeOwner'])->name('become');
    });
});
