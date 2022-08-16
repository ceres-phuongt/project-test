<?php

namespace Backend\User\Providers;

use App\Http\Middleware\VerifyCsrfToken;
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
use Backend\User\Http\Middleware\DemoMiddleware;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(ExceptionHandler::class, CustomHandlerException::class);
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

        $this->app->bind('core', function () {
            return new Core();
        });

        // NOTE: This facade can be loaded directly via PHP code, not using composer
        AliasLoader::getInstance()->alias('CoreFacadeLoadedDirectly', CoreFacadeLoadedDirectlyFacade::class);
    }

    public function provides()
    {
        return ['core'];
    }
}
