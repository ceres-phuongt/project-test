<?php

namespace Backend\Dashboard\Providers;

use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Routing\Middleware\ValidateSignature;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class DashboardServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // NOTE: Load migrations from path
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        // NOTE: Load routes, you can load many route files as you wish.
        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');

        // NOTE: Load views, the same as load routes
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'backend/dashboard');
    }

    public function provides()
    {
        return ['dashboard'];
    }
}
