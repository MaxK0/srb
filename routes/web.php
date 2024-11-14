
<?php

use App\Http\Controllers\BranchController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsOwner;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/sitemap.xml', [SitemapController::class, 'index']);

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

    Route::prefix('/branches')->name('branches.')->group(function () {
        Route::get('/create', [BranchController::class, 'create'])->name('create')
            ->middleware('can:create,\App\Models\Owner\Branch');

        Route::post('', [BranchController::class, 'store'])->name('store')
            ->middleware('can:create,\App\Models\Owner\Branch');

        Route::get('/{branch}', [BranchController::class, 'show'])->name('show')
            ->middleware('can:view,branch');

        Route::get('/{branch}/edit', [BranchController::class, 'edit'])->name('edit')
            ->middleware('can:update,branch');

        Route::put('/{branch}', [BranchController::class, 'update'])->name('update')
            ->middleware('can:update,branch');

        Route::delete('/{branch}', [BranchController::class, 'destroy'])->name('destroy')
            ->middleware('can:delete,branch');
    });

    Route::prefix('/positions')->name('positions.')->group(function () {
        Route::get('', [PositionController::class, 'index'])->name('index')
            ->middleware('can:viewAny,\App\Models\Employee\Position');

        Route::get('/create', [PositionController::class, 'create'])->name('create')
            ->middleware('can:create,\App\Models\Employee\Position');

        Route::post('', [PositionController::class, 'store'])->name('store')
            ->middleware('can:create,\App\Models\Employee\Position');

        Route::get('/{position}', [PositionController::class, 'show'])->name('show')
            ->middleware('can:view,position');

        Route::get('/{position}/edit', [PositionController::class, 'edit'])->name('edit')
            ->middleware('can:update,position');

        Route::put('/{position}', [PositionController::class, 'update'])->name('update')
            ->middleware('can:update,position');

        Route::delete('/{position}', [PositionController::class, 'destroy'])->name('destroy')
            ->middleware('can:delete,position');
    });

    Route::prefix('/employees')->name('employees.')->group(function () {
        Route::get('', [EmployeeController::class, 'index'])->name('index')
            ->middleware('can:viewAny,\App\Models\Employee\Employee');

        Route::get('/create', [EmployeeController::class, 'create'])->name('create')
            ->middleware('can:create,\App\Models\Employee\Employee');

        Route::post('', [EmployeeController::class, 'store'])->name('store')
            ->middleware('can:create,\App\Models\Employee\Employee');

        Route::get('/{employee}', [EmployeeController::class, 'show'])->name('show')
            ->middleware('can:view,employee');

        Route::get('/{employee}/edit', [EmployeeController::class, 'edit'])->name('edit')
            ->middleware('can:update,employee');

        Route::put('/{employee}', [EmployeeController::class, 'update'])->name('update')
            ->middleware('can:update,employee');

        Route::delete('/{employee}', [EmployeeController::class, 'destroy'])->name('destroy')
            ->middleware('can:delete,employee');

        Route::get('/{user}/hire', [EmployeeController::class, 'hire'])->name('hire')
            ->middleware('can:hire,user');

        Route::post('/{user}/hire', [EmployeeController::class, 'hireStore'])->name('hire.store')
            ->middleware('can:hire,user');
    });

    Route::name('owner.')->group(function () {
        Route::post('/becomeOwner', [OwnerController::class, 'becomeOwner'])->name('become')
            ->middleware('can:create,\App\Models\Owner\Owner');
    });

    Route::middleware(IsOwner::class)->group(function () {
        Route::post('users/find', [UserController::class, 'find'])->name('users.find');

        // Route::resource('clients', ClientController::class)->except(['edit', 'update', 'delete']);
        // Route::post('clients/{user}/attachUser', [ClientController::class, 'attachUserToClients'])->name('clients.attachUser');
    });

});
