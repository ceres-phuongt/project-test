<?php

namespace Frontend\Theme\Providers;

use Backend\User\Models\User;
use Frontend\Theme\Http\Middleware\CheckIfNotMember;
use Frontend\Theme\Http\Middleware\CheckMemberLogin;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class ThemeServiceProvider extends ServiceProvider
{
    public function register()
    {
        config([
            'auth.guards.member'     => [
                'driver'   => 'session',
                'provider' => 'members',
            ],
            'auth.providers.members' => [
                'driver' => 'eloquent',
                'model'  => User::class,
            ],
            'auth.passwords.members' => [
                'provider' => 'members',
                'table'    => 'password_resets',
                'expire'   => 60,
            ],
        ]);
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
        $this->mergeConfigFrom(__DIR__.'/../../config/scout.php', 'scout');
        $this->mergeConfigFrom(__DIR__.'/../../config/elasticsearch.php', 'elasticsearch');

        // AliasLoader::getInstance()->alias('ElasticSearchServiceProvider', \Matchish\ScoutElasticSearch\ElasticSearchServiceProvider::class);

        Event::listen(RouteMatched::class, function () {
            /**
             * @var Router $router
             */
            $router = $this->app['router'];

            $router->aliasMiddleware('member:guest', CheckIfNotMember::class);
            $router->aliasMiddleware('member', CheckMemberLogin::class);
        });
    }
}
