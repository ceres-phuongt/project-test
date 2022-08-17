<?php

namespace Backend\Car\Providers;

use Backend\Car\Models\Car;
use Backend\Car\Repositories\Eloquent\CarRepository;
use Backend\Car\Repositories\Eloquent\EngineSizeRepository;
use Backend\Car\Repositories\Eloquent\MakeRepository;
use Backend\Car\Repositories\Eloquent\TagRepository;
use Backend\Car\Repositories\Interfaces\CarInterface;
use Backend\Car\Repositories\Interfaces\EngineSizeInterface;
use Backend\Car\Repositories\Interfaces\MakeInterface;
use Backend\Core\Repositories\Eloquent\BaseRepository;
use Backend\Core\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class CarServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(CarInterface::class, CarRepository::class);
        $this->app->bind(TagInterface::class, TagRepository::class);
        $this->app->bind(EngineSizeInterface::class, EngineSizeRepository::class);
        $this->app->bind(MakeInterface::class, MakeRepository::class);
    }

    public function boot()
    {
        // NOTE: Load migrations from path
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        // NOTE: Load routes, you can load many route files as you wish.
        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');

        // NOTE: Load views, the same as load routes
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'backend/car');

        // NOTE: Load configs
        $this->mergeConfigFrom(__DIR__ . '/../../config/car.php', 'car');
    }

    public function provides()
    {
        return ['car'];
    }
}
