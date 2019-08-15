<?php

namespace App\Modules\Site\Providers;

use Caffeinated\Modules\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(module_path('site', 'Resources/Lang', 'app'), 'site');
        $this->loadViewsFrom(module_path('site', 'Resources/Views', 'app'), 'site');
        $this->loadMigrationsFrom(module_path('site', 'Database/Migrations', 'app'), 'site');
        $this->loadConfigsFrom(module_path('site', 'Config', 'app'));
        $this->loadFactoriesFrom(module_path('site', 'Database/Factories', 'app'));
    }

    /**
     * Register the module services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }
}
