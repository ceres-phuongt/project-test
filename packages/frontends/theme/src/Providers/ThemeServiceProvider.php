<?php

namespace Frontend\Theme\Providers;

use Backend\Core\Repositories\Eloquent\BaseRepository;
use Backend\Core\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class ThemeServiceProvider extends ServiceProvider
{
    public function register()
    {
    }

    public function boot()
    {
        // NOTE: Load migrations from path
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        // NOTE: Load routes, you can load many route files as you wish.
        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');

        // NOTE: Load views, the same as load routes
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'frontend/theme');

        // NOTE: Load configs
        $this->mergeConfigFrom(__DIR__.'/../../config/theme.php', 'theme');
    }
}
