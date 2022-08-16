<?php

namespace Backend\Core\Providers;

use App\Http\Middleware\VerifyCsrfToken;
use Backend\Core\Repositories\Eloquent\BaseRepository;
use Backend\Core\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Routing\Middleware\ValidateSignature;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider
{
    // public function register()
    // {
    //     $this->app->bind(RepositoryInterface::class, BaseRepository::class);
    // }

    public function boot()
    {
        // NOTE: Load views, the same as load routes
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'backend/core');

        // NOTE: Load configs
        $this->mergeConfigFrom(__DIR__ . '/../../config/general.php', 'core');
    }

    public function provides()
    {
        return ['core'];
    }
}
