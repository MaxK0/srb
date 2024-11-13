
<?php

use App\Http\Controllers\BranchController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsOwner;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule.index');


    Route::prefix('/businesses')->name('businesses.')->group(function () {
        Route::get('', [BusinessController::class, 'index'])->name('index')
            ->middleware('can:viewAny,\App\Models\Owner\Business');

        Route::get('/create', [BusinessController::class, 'create'])->name('create')
            ->middleware('can:create,\App\Models\Owner\Business');

        Route::post('', [BusinessController::class, 'store'])->name('store')
            ->middleware('can:create,\App\Models\Owner\Business');

        Route::get('/{business}', [BusinessController::class, 'show'])->name('show')
            ->middleware('can:view,business');

        Route::get('/{business}/edit', [BusinessController::class, 'edit'])->name('edit')
            ->middleware('can:update,business');

        Route::put('/{business}', [BusinessController::class, 'update'])->name('update')
            ->middleware('can:update,business');

        Route::delete('/{business}', [BusinessController::class, 'destroy'])->name('destroy')
            ->middleware('can:delete,business');
    });


    Route::middleware(IsOwner::class)->group(function () {
        Route::post('users/find', [UserController::class, 'find'])->name('users.find');
        Route::resource('branches', BranchController::class)->except('index');
        Route::resource('positions', PositionController::class);

        Route::resource('employees', EmployeeController::class);
        Route::get('employees/{user}/hire', [EmployeeController::class, 'hire'])->name('employees.hire');
        Route::post('employees/{user}/hire', [EmployeeController::class, 'hireStore'])->name('employees.hire.store');

        Route::resource('clients', ClientController::class)->except(['edit', 'update', 'delete']);
        Route::post('clients/{user}/attachUser', [ClientController::class, 'attachUserToClients'])->name('clients.attachUser');
    });

    Route::name('owner.')->group(function () {
        Route::post('/becomeOwner', [OwnerController::class, 'becomeOwner'])->name('become');
    });
});
