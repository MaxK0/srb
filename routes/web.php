<?php

use App\Http\Controllers\BranchController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ExtraDayController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkdayController;
use App\Http\Controllers\WorklessDayController;
use App\Http\Middleware\IsOwner;
use App\Models\Employee\Employee;
use App\Models\Employee\Position;
use App\Models\Employee\Workday\ExtraDay;
use App\Models\Employee\Workday\Workday;
use App\Models\Employee\Workday\WorklessDay;
use App\Models\Owner\Branch;
use App\Models\Owner\Business;
use App\Models\Owner\Owner;
use App\Models\User\User;
use App\Policies\ExtraDayPolicy;
use Carbon\Carbon;
use Illuminate\Foundation\Application;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/sitemap', [SitemapController::class, 'index']);

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
            ->can('viewAny', Business::class);

        Route::get('/create', [BusinessController::class, 'create'])->name('create')
            ->can('create', Business::class);

        Route::post('', [BusinessController::class, 'store'])->name('store')
            ->can('create', Business::class);

        Route::get('/{business}', [BusinessController::class, 'show'])->name('show')
            ->can('view', 'business');

        Route::get('/{business}/edit', [BusinessController::class, 'edit'])->name('edit')
            ->can('update', 'business');

        Route::put('/{business}', [BusinessController::class, 'update'])->name('update')
            ->can('update', 'business');

        Route::delete('/{business}', [BusinessController::class, 'destroy'])->name('destroy')
            ->can('delete', 'business');
    });

    Route::prefix('/branches')->name('branches.')->group(function () {
        Route::get('/create', [BranchController::class, 'create'])->name('create')
            ->can('create', Branch::class);

        Route::post('', [BranchController::class, 'store'])->name('store')
            ->can('create', Branch::class);

        Route::get('/{branch}', [BranchController::class, 'show'])->name('show')
            ->can('view', 'branch');

        Route::get('/{branch}/edit', [BranchController::class, 'edit'])->name('edit')
            ->can('update', 'branch');

        Route::put('/{branch}', [BranchController::class, 'update'])->name('update')
            ->can('update', 'branch');

        Route::delete('/{branch}', [BranchController::class, 'destroy'])->name('destroy')
            ->can('delete', 'branch');

        // TODO: policy?
        Route::post('/change', [BranchController::class, 'change'])->name('change');
    });

    Route::prefix('/positions')->name('positions.')->group(function () {
        Route::get('', [PositionController::class, 'index'])->name('index')
            ->can('viewAny', Position::class);

        Route::get('/create', [PositionController::class, 'create'])->name('create')
            ->can('create', Position::class);

        Route::post('', [PositionController::class, 'store'])->name('store')
            ->can('create', Position::class);

        Route::get('/{position}', [PositionController::class, 'show'])->name('show')
            ->can('view', 'position');

        Route::get('/{position}/edit', [PositionController::class, 'edit'])->name('edit')
            ->can('update', 'position');

        Route::put('/{position}', [PositionController::class, 'update'])->name('update')
            ->can('update', 'position');

        Route::delete('/{position}', [PositionController::class, 'destroy'])->name('destroy')
            ->can('delete', 'position');

        Route::delete('/{position}/withoutRedirect', [PositionController::class, 'destroyWithoutRedirect'])->name('destroyWithoutRedirect')
            ->can('delete', 'position');
    });

    Route::prefix('/employees')->name('employees.')->group(function () {
        Route::get('', [EmployeeController::class, 'index'])->name('index')
            ->can('viewAny', Employee::class);

        Route::get('/create', [EmployeeController::class, 'create'])->name('create')
            ->can('create', Employee::class);

        Route::post('', [EmployeeController::class, 'store'])->name('store')
            ->can('create', Employee::class);

        Route::get('/{employee}', [EmployeeController::class, 'show'])->name('show')
            ->can('view', 'employee');

        Route::get('/{employee}/edit', [EmployeeController::class, 'edit'])->name('edit')
            ->can('update', 'employee');

        Route::put('/{employee}', [EmployeeController::class, 'update'])->name('update')
            ->can('update', 'employee');

        Route::delete('/{employee}', [EmployeeController::class, 'destroy'])->name('destroy')
            ->can('delete', 'employee');

        Route::delete('/{employee}/withoutRedirect', [EmployeeController::class, 'destroyWithoutRedirect'])->name('destroyWithoutRedirect')
            ->can('delete', 'employee');

            //TODO: у одного сотрудника только одно расписание.
        Route::prefix('/{employee}/workday')->name('workday.')->group(function () {
            Route::get('/create', [WorkdayController::class, 'create'])->name('create')
                ->can('create', [Workday::class, 'employee']);

            Route::post('', [WorkdayController::class, 'store'])->name('store')
                ->can('create', [Workday::class, 'employee']);

            Route::get('', [WorkdayController::class, 'show'])->name('show')
                ->can('view', [Workday::class, 'employee']);

            Route::get('/edit', [WorkdayController::class, 'edit'])->name('edit')
                ->can('update', [Workday::class, 'employee']);

            Route::put('', [WorkdayController::class, 'update'])->name('update')
                ->can('update', [Workday::class, 'employee']);

            Route::delete('', [WorkdayController::class, 'destroy'])->name('destroy')
                ->can('delete', [Workday::class, 'employee']);

            Route::prefix('/extraDays')->name('extra.')->group(function () {
                Route::get('/create', [ExtraDayController::class, 'create'])->name('create')
                    ->can('create', ExtraDay::class);

                Route::post('', [ExtraDayController::class, 'store'])->name('store')
                    ->can('create', ExtraDay::class);

                Route::get('/{extraDay}/edit', [ExtraDayController::class, 'edit'])->name('edit')
                    ->can('update', 'extraDay');

                Route::put('/{extraDay}', [ExtraDayController::class, 'update'])->name('update')
                    ->can('update', 'extraDay');

                Route::delete('/{extraDay}', [ExtraDayController::class, 'destroy'])->name('destroy')
                    ->can('delete', 'extraDay');
            });

            Route::prefix('/worklessDays')->name('workless.')->group(function () {
                Route::get('/create', [WorklessDayController::class, 'create'])->name('create')
                    ->can('create', WorklessDay::class);

                Route::post('', [WorklessDayController::class, 'store'])->name('store')
                    ->can('create', WorklessDay::class);

                Route::get('/{worklessDay}/edit', [WorklessDayController::class, 'edit'])->name('edit')
                    ->can('update', 'worklessDay');

                Route::put('/{worklessDay}', [WorklessDayController::class, 'update'])->name('update')
                    ->can('update', 'worklessDay');

                Route::delete('/{worklessDay}', [WorklessDayController::class, 'destroy'])->name('destroy')
                    ->can('delete', 'worklessDay');
            });
        });
    });

    Route::name('owner.')->group(function () {
        Route::post('/becomeOwner', [OwnerController::class, 'becomeOwner'])->name('become')
            ->can('create', Owner::class);
    });

    Route::prefix('/users')->name('users.')->group(function () {
        Route::post('/find', [UserController::class, 'find'])->name('find')
            ->can('find', User::class);

        Route::get('/{user}/hire', [UserController::class, 'hire'])->name('hire')
            ->can('hire', 'user');

        Route::post('/{user}/hire', [UserController::class, 'hireStore'])->name('hire.store')
            ->can('hire', 'user');

        Route::post('/{user}/attachToClients', [UserController::class, 'attachToClients'])->name('attachToClients')
            ->can('attachToClients', 'user');
    });

    Route::middleware(IsOwner::class)->group(function () {
        Route::resource('clients', ClientController::class)->except(['edit', 'update', 'destroy']);

        Route::post('clients/{user}/detachClient', [ClientController::class, 'detachClient'])->name('clients.attachUser');
    });

    Route::resource('branches.services', \App\Http\Controllers\ServiceController::class)
        ->scoped(['service' => 'id'])
        ->parameters(['services' => 'service']);
});
