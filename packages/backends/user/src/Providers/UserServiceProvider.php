<?php

namespace Backend\User\Providers;

use App\Http\Middleware\VerifyCsrfToken;
use Backend\User\Http\Middleware\Authenticate;
use Backend\User\Http\Middleware\RedirectIfAuthenticated;
use Backend\User\Models\User;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Routing\Middleware\ValidateSignature;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Backend\User\Commands\DemoCommand;
use Backend\User\Exceptions\CustomHandlerException;
use Backend\User\Facades\CoreFacadeLoadedDirectlyFacade;
use Backend\User\Http\Middleware\CustomVerifyCsrfTokenMiddleware;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
    }

    // packages/core/src/Providers/CoreServiceProvider.php
    public function boot()
    {
        // NOTE: Load migrations from path
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        // NOTE: Load routes, you can load many route files as you wish.
        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');

        // NOTE: Load views, the same as load routes
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'backend/user');

        // NOTE: Load configs
        $this->mergeConfigFrom(__DIR__ . '/../../config/user.php', 'user');

        Event::listen(RouteMatched::class, function () {
            /**
             * @var Router $router
             */
            $router = $this->app['router'];

            $router->aliasMiddleware('auth', Authenticate::class);
            $router->aliasMiddleware('guest', RedirectIfAuthenticated::class);
        });

        $this->app->booted(function () {
            config()->set(['auth.providers.users.model' => User::class]);
        });
    }
}
