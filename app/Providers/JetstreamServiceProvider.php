<?php

namespace App\Providers;

use App\Actions\Jetstream\DeleteUser;
use App\Models\User\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Laravel\Fortify\Fortify;
use Laravel\Jetstream\Jetstream;

class JetstreamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configurePermissions();

        Jetstream::deleteUsersUsing(DeleteUser::class);

        Fortify::authenticateUsing(function (Request $request) {
            $login = $request->login;

            if ($request->is_phone) {
                $login = preg_replace("/[^0-9]/", "", $request->login);
            }

            $user = User::where('email', $login)
                ->orWhere('phone', $login)
                ->first();

            if ($user && Hash::check($request->password, $user->password)) {
                return $user;
            }
            
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        });

        Fortify::registerView(function () {
            $userService = app(UserService::class);

            return Inertia::render('Auth/Register', [
                'sexes' => $userService->getSexes()
            ]);
        });
    }

    /**
     * Configure the permissions that are available within the application.
     */
    protected function configurePermissions(): void
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::permissions([
            'create',
            'read',
            'update',
            'delete',
        ]);
    }
}
