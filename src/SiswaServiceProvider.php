<?php

namespace Bantenprov\Siswa;

use Illuminate\Support\ServiceProvider;
use Bantenprov\Siswa\Console\Commands\SiswaCommand;

/**
 * The SiswaServiceProvider class
 *
 * @package Bantenprov\Siswa
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class SiswaServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->routeHandle();
        $this->configHandle();
        $this->langHandle();
        $this->viewHandle();
        $this->assetHandle();
        $this->migrationHandle();
        $this->publicHandle();
        $this->seedHandle();
        $this->publishHandle();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('siswa', function ($app) {
            return new Siswa;
        });

        $this->app->singleton('command.siswa', function ($app) {
            return new SiswaCommand;
        });

        $this->commands('command.siswa');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'siswa',
            'command.siswa',
        ];
    }

    /**
     * Loading and publishing package's config
     *
     * @return void
     */
    protected function configHandle($publish = '')
    {
        $packageConfigPath = __DIR__.'/config';
        $appConfigPath     = config_path('bantenprov/siswa');

        $this->mergeConfigFrom($packageConfigPath.'/siswa.php', 'siswa');

        $this->publishes([
            $packageConfigPath.'/siswa.php' => $appConfigPath.'/siswa.php',
        ], $publish ? $publish : 'siswa-config');
    }

    /**
     * Loading package routes
     *
     * @return void
     */
    protected function routeHandle()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/routes.php');
    }

    /**
     * Loading and publishing package's translations
     *
     * @return void
     */
    protected function langHandle($publish = '')
    {
        $packageTranslationsPath = __DIR__.'/resources/lang';

        $this->loadTranslationsFrom($packageTranslationsPath, 'siswa');

        $this->publishes([
            $packageTranslationsPath => resource_path('lang/vendor/siswa'),
        ], $publish ? $publish : 'siswa-lang');
    }

    /**
     * Loading and publishing package's views
     *
     * @return void
     */
    protected function viewHandle($publish = '')
    {
        $packageViewsPath = __DIR__.'/resources/views';

        $this->loadViewsFrom($packageViewsPath, 'siswa');

        $this->publishes([
            $packageViewsPath => resource_path('views/vendor/siswa'),
        ], $publish ? $publish : 'siswa-views');
    }

    /**
     * Publishing package's assets (JavaScript, CSS, images...)
     *
     * @return void
     */
    protected function assetHandle($publish = '')
    {
        $packageAssetsPath = __DIR__.'/resources/assets';

        $this->publishes([
            $packageAssetsPath => resource_path('assets'),
        ], $publish ? $publish : 'siswa-assets');
    }

    /**
     * Publishing package's migrations
     *
     * @return void
     */
    protected function migrationHandle($publish = '')
    {
        $packageMigrationsPath = __DIR__.'/database/migrations';

        $this->loadMigrationsFrom($packageMigrationsPath);

        $this->publishes([
            $packageMigrationsPath => database_path('migrations')
        ], $publish ? $publish : 'siswa-migrations');
    }

    /**
     * Publishing package's publics (JavaScript, CSS, images...)
     *
     * @return void
     */
    public function publicHandle($publish = '')
    {
        $packagePublicPath = __DIR__.'/public';

        $this->publishes([
            $packagePublicPath => base_path('public')
        ], $publish ? $publish : 'siswa-public');
    }

    /**
     * Publishing package's seeds
     *
     * @return void
     */
    public function seedHandle($publish = '')
    {
        $packageSeedPath = __DIR__.'/database/seeds';

        $this->publishes([
            $packageSeedPath => base_path('database/seeds')
        ], $publish ? $publish : 'siswa-seeds');
    }

    /**
     * Publishing package's all files
     *
     * @return void
     */
    public function publishHandle()
    {
        $publish = 'siswa-publish';

        $this->routeHandle($publish);
        $this->configHandle($publish);
        $this->langHandle($publish);
        $this->viewHandle($publish);
        $this->assetHandle($publish);
        // $this->migrationHandle($publish);
        $this->publicHandle($publish);
        $this->seedHandle($publish);
    }
}
